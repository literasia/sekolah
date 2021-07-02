<?php

namespace App\Http\Controllers\Admin\Fungsionaris;

use App\Http\Controllers\Controller;
use App\Utils\CRUDResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Superadmin\{Provinsi, KabupatenKota, Kecamatan, Addons, Sekolah};
use App\Models\Admin\Access;
use App\Models\{BagianPegawai, Semester, Pegawai};
use App\{User, Role};
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PegawaiController extends Controller
{ //
    private const AGAMA_RULE = "Islam,Budha,Kristen Protestan,Hindu,Kristen Katolik,Konghuchu";

    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        if ($request->ajax()) {
            $data = Pegawai::whereHas('user', function($query){
                $query->where('id_sekolah', auth()->user()->id_sekolah);
            })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $sekolah = Sekolah::findOrFail(auth()->user()->id_sekolah);
        $tahun_ajaran = $request->tahun_ajaran;
        $kelas_id = $request->kelas_id;

        $provinsis = Provinsi::all();
        $kabupaten = KabupatenKota::all();
        $kecamatan  = Kecamatan::all();
        $bagian = BagianPegawai::where('user_id', Auth::id())->get();
        $semester = Sekolah::where('id', auth()->user()->id_sekolah)->get();

        

        return view('admin.fungsionaris.pegawai',  compact('sekolah', 'tahun_ajaran'), ['provinsis' => $provinsis, 
                                                'addons' => $addons , 
                                                'tahun_ajaran' => $sekolah,
                                                'sekolah' => $sekolah,
                                                'kabupaten' => $kabupaten, 
                                                'kecamatan' => $kecamatan,
                                                'bagian' => $bagian, 
                                                'semester' => $semester, 
                                                'mySekolah' => User::sekolah()]);
    }

    public function getKabupatenKota($id)
    {
        $kabupaten = Provinsi::find($id)->kabupatenKotas;
        return response()->json($kabupaten);
    }

    public function store(Request $request) {
        // Validation rules
        $rules = [
            'tanggal_lahir' => ['nullable', 'date'],
            'jk' => ['nullable', 'in:Laki-Laki,Perempuan'],
            'agama' => ['nullable', 'in:' . PegawaiController::AGAMA_RULE],
            'is_menikah' => ['nullable', 'boolean'],
            'tanggal_mulai' => ['nullable', 'date'],
            'foto' => ['nullable', 'mimes:jpeg,jpg,png']
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        // Add User
        $user = User::create([
            'role_id' => 4,
            'id_sekolah' => auth()->user()->id_sekolah,
            'name' => $request->name,
            'username' => $request->username,
            'nis' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // $user_id = User::findOrFail($user->id);

        // // get Roles to attach user roles
        // $role = Role::where('name', 'pegawai')->first();

        // // attach
        // $user_id->roles()->attach($role->id);

        // Add Photo to public
        $data = $request->all();

        // $request->foto = null;
        // if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('pegawais', 'public');
        // }

        // Change Date Type
        $data['tanggal_lahir'] = Carbon::parse($data['tanggal_lahir'])->format('Y-m-d');
        $data['tanggal_mulai'] = Carbon::parse($data['tanggal_mulai'])->format('Y-m-d');
        $data['user_id'] = $user->id;

        // Create Pegawai
        $pegawai = Pegawai::create($data);

        // Create Accesses
        $access = Access::create([
            'sekolah_id'=> auth()->user()->id_sekolah,
            'pegawai_id'=> $pegawai->id,
        ]);
    
        // Respons Data
        return response()->json(['success' => 'Data berhasil disimpan.']);
    }

    public function edit($id) {
        $pegawai = Pegawai::findOrFail($id);
        $provinsis = Provinsi::all();
        $kabupaten = KabupatenKota::all();
        $kecamatan  = Kecamatan::all();
        $bagian = BagianPegawai::where('user_id', auth()->user()->id)->get();
        $semester = Sekolah::where('id', auth()->user()->id_sekolah)->get();

        // get User
        $user = User::findOrFail($pegawai->user_id);

        return response()
            ->json([                
                'id'   => $pegawai->id,
                'username' => $user->username,                
                'name'   => $pegawai->name,
                'email'   => $pegawai->email,
                'nip'   => $pegawai->nip,
                'provinsi_id'   => $pegawai->provinsi_id,
                'kabupaten_kota_id'   => $pegawai->kabupaten_kota_id,
                'kecamatan_id'   => $pegawai->kecamatan_id,
                'nik'   => $pegawai->nik,
                'gelar_depan'   => $pegawai->gelar_depan,
                'gelar_belakang'   => $pegawai->gelar_belakang,
                'tempat_lahir' => $pegawai->tempat_lahir,
                'jk' => $pegawai->jk,
                'agama' => $pegawai->agama,
                'is_menikah' => $pegawai->is_menikah,
                'alamat_tinggal' => $pegawai->alamat_tinggal,
                'tanggal_lahir' => $pegawai->tanggal_lahir,
                'dusun' => $pegawai->dusun,
                'rt' => $pegawai->rt,
                'rw' => $pegawai->rw,
                'kode_pos' => $pegawai->kode_pos,
                'no_telepon_rumah' => $pegawai->no_telepon_rumah,
                'no_telepon' => $pegawai->no_telepon,
                'email' => $pegawai->email,
                'tanggal_mulai' => $pegawai->tanggal_mulai,
                'tahun_ajaran' => $pegawai->tahun_ajaran,
                'jenjang' => $pegawai->jenjang,
                'foto' => $pegawai->foto,
                'bagian_pegawai_id' => $pegawai->bagian_pegawai_id,
                'semester' => $pegawai->semester
            ]);
    }

    public function update(Request $request) {
        $data = $request->all();
        $id = $request->hidden_id;

        // Validation rules
        $rules = [
            'tanggal_lahir' => ['nullable', 'date'],
            'jk' => ['nullable', 'in:Laki-Laki,Perempuan'],
            'agama' => ['nullable', 'in:' . PegawaiController::AGAMA_RULE],
            'is_menikah' => ['nullable', 'boolean'],
            'tanggal_mulai' => ['nullable', 'date'],
            'password_baru' => 'required_with:password_confirmation',
            'password_confirmation' => 'same:password_baru'
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        $pegawai = Pegawai::findOrFail($id);
        $currFoto = $pegawai->foto;
        $data['foto'] = $pegawai->foto;
        $data['name'] = $data['name'];

        // Request new photo
        // if ($request->file('foto')) {
        //     // Insert new photo
        //     $data['foto'] = $request->file('foto')->store('pegawais', 'public');
        //     // if exist same file photo delete it
        //     if ($request->file('foto') && $currFoto && Storage::disk('public')->exists($currFoto)) {
        //         Storage::disk('public')->delete($currFoto);
        //     }
        // } 

        if($request->file('foto')){
            if(Storage::disk('public')->exists($pegawai->foto)){
                Storage::disk('public')->delete($pegawai->foto);
            }
            $data['foto'] = $request->file('foto')->store('pegawais','public');
        }

        // Change User Password
        // get user
        $user = User::findOrFail($pegawai->user_id);

        if (!empty($request->password_lama)) {
            if (Hash::check($request->password_lama, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password_baru)
                ]);
            }
            else{
                return response()->json([
                    'error_old_password' => true
                ]);
            }
        }

        $pegawai->update($request->all());   

        // Respons Data
        return response()->json(['success' => 'Data berhasil diubah.']);
    }

    public function destroy($id) {
        $pegawai = Pegawai::findOrFail($id);
        $access = $pegawai->access->delete();
        $pegawai->delete();

        // if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
        //     Storage::disk('public')->delete($pegawai->foto);
        // }

        if(Storage::disk('public')->exists($pegawai->foto)){
            Storage::disk('public')->delete($pegawai->foto);
        }

        // Respons Data
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
