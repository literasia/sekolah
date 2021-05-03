<?php

namespace App\Http\Controllers\Superadmin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Superadmin\Sekolah;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Superadmin\Provinsi;
use App\Models\Superadmin\KabupatenKota;
use App\Models\Admin\Access;

class ListSekolahController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Sekolah::join('provinsis', 'sekolahs.provinsi', 'provinsis.id')
                ->join('kabupaten_kotas', 'sekolahs.kabupaten', 'kabupaten_kotas.id')
                ->latest()->get(['sekolahs.*', 'provinsis.name AS provinsis', 'kabupaten_kotas.name AS kabupatens']);
            // return($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    // $button .= '&nbsp;&nbsp;&nbsp;<button type="button" onclick="deleteConfirmation('.$data->id.')" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $provinsis = Provinsi::all();
        $kabupaten = KabupatenKota::all();

        return view('superadmin.list-sekolah', ['provinsis' => $provinsis, 'kabupaten' => $kabupaten]);
    }

    public function store(Request $req) {
        $data = $req->all();
        $rules = [
            'id_sekolah'    => 'required|max:100',
            'name'          => 'required|max:100',
            'alamat'        => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'jenjang'       => 'required',
            'tahun_ajaran'  => 'required',
            'username'      => 'required|max:100|unique:users,username',
            'password'      => 'required',
            // 'logo'          => ['nullable', 'mimes:jpeg,jpg,png,svg', 'max:2000']
        ];

        $message = [
            'id_sekolah.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        $sekolahId = Sekolah::create([
            'id_sekolah'    => $data['id_sekolah'],
            'name'          => $data['name'],
            'alamat'        => $data['alamat'],
            'provinsi'      => $data['provinsi'],
            'kabupaten'     => $data['kabupaten'],
            'jenjang'       => $data['jenjang'],
            'tahun_ajaran'  => $data['tahun_ajaran'],
            // 'logo'          => $data['logo']
        ])->id;
    
        
        // Get Roles
        $adminRole = Role::where('name', 'admin')->first();

        $user = User::create([
            'id_sekolah'    => $sekolahId,
            'role_id'       => $adminRole->id,
            'name'          => $data['name'],
            'username'      => $data['username'],
            'password'      => Hash::make($data['password'])
        ]);

        $user_id = User::findOrFail($user->id);

        // Attach to Role User
        $user_id->roles()->attach($adminRole->id);
        
        // tambah Accesses
        Access::create([
            'sekolah_id' => $sekolahId,
            'pegawai_id' => NULL,
            'kalender' => !empty($req->kalender) ? 1 : 0,
            'sekolah' => !empty($req->sekolah) ? 1 : 0,
            'pelajaran' => !empty($req->pelajaran) ? 1 : 0,
            'peserta_didik' => !empty($req->peserta_didik) ? 1 : 0,
            'absensi' => !empty($req->absensi) ? 1 : 0,
            'daftar_nilai' => !empty($req->daftar_nilai) ? 1 : 0,
            'pelanggaran' => !empty($req->pelanggaran) ? 1 : 0,
            'template' => !empty($req->template) ? 1 : 0,
            'log_user' => !empty($req->log_user) ? 1 : 0,
            'referensi' => !empty($req->referensi) ? 1 : 0,
            'buku_tamu' => !empty($req->buku_tamu) ? 1 : 0,
            'konsultasi' => !empty($req->konsultasi) ? 1 : 0,
            'perpustakaan' => !empty($req->perpustakaan) ? 1 : 0,
            'keuangan' => !empty($req->keuangan) ? 1 : 0,
            'sarana_prasarana' => !empty($req->sarana_prasarana) ? 1 : 0,
            'penerimaan_murid_baru' => !empty($req->penerimaan_murid_baru) ? 1 : 0,
            'ujian_sekolah_berbasis_komputer' => !empty($req->ujian_sekolah_berbasis_komputer) ? 1 : 0,
            'e_voting' => !empty($req->e_voting) ? 1 : 0,
        ]);

        return back()->with(CRUDResponse::successCreate("sekolah " . $data['name']));
    }

    public function edit($id) {
        $sekolah = Sekolah::findOrFail($id);
        $provinsi = Provinsi::findOrFail($sekolah->provinsi);
        $kabupaten = KabupatenKota::findOrFail($sekolah->kabupaten);

        // get accesses
        $accesses = Access::where('sekolah_id', $sekolah->id)->first();

        return response()
            ->json([                
                'id'   => $sekolah->id,
                'id_sekolah'   => $sekolah->id_sekolah,
                'name'   => $sekolah->name,
                'alamat'   => $sekolah->alamat,
                'provinsi'   => $provinsi->id,
                'kabupaten'   => $kabupaten->id,
                'jenjang'   => $sekolah->jenjang,
                'tahun_ajaran'   => $sekolah->tahun_ajaran,
                'user'      => User::where('id_sekolah', $sekolah->id)->get(),
                'kalender' => $accesses->kalender,
                'sekolah' => $accesses->sekolah,
                'pelajaran' => $accesses->pelajaran,
                'peserta_didik' => $accesses->peserta_didik,
                'absensi' => $accesses->absensi,
                'daftar_nilai' => $accesses->daftar_nilai,
                'pelanggaran' => $accesses->pelanggaran,
                'template' => $accesses->template,
                'log_user' => $accesses->log_user,
                'referensi' => $accesses->referensi,
                'buku_tamu' => $accesses->buku_tamu,
                'konsultasi' => $accesses->konsultasi,
                'perpustakaan' => $accesses->perpustakaan,
                'keuangan' => $accesses->keuangan,
                'sarana_prasarana' => $accesses->sarana_prasarana,
                'penerimaan_murid_baru' => $accesses->penerimaan_murid_baru,
                'keuangan' => $accesses->keuangan,
                'ujian_sekolah_berbasis_komputer' => $accesses->ujian_sekolah_berbasis_komputer,
                'e_voting' => $accesses->e_voting,
            ]);
    }

    public function update(Request $req) {
        $data = $req->all();
        $id = $data['hidden_id'];
        
        Sekolah::findOrFail($id);

        $rules = [
           'id_sekolah'    => 'max:100',
           'name'          => 'required|max:100',
           'alamat'        => 'required',
           'provinsi'        => 'required',
           'kabupaten'        => 'required',
           'jenjang'       => 'required',
           'tahun_ajaran'  => 'required',
        ];

        $message = [
            'id_sekolah.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
                return back()->withErrors($validator->errors()->all())->withInput();
        }

        Sekolah::whereId($id)->update([
            'id_sekolah'    => $data['id_sekolah'],
            'name'          => $data['name'],
            'alamat'        => $data['alamat'],
            'provinsi'        => $data['provinsi'],
            'kabupaten'        => $data['kabupaten'],
            'jenjang'       => $data['jenjang'],
            'tahun_ajaran'  => $data['tahun_ajaran'],
            // 'logo'          => $data['logo']
        ]);

        $accesses = Access::where('sekolah_id', $data['hidden_id'])->first();

        // tambah Accesses
        $accesses->update([
            'kalender' => !empty($req->kalender) ? 1 : 0,
            'sekolah' => !empty($req->sekolah) ? 1 : 0,
            'pelajaran' => !empty($req->pelajaran) ? 1 : 0,
            'peserta_didik' => !empty($req->peserta_didik) ? 1 : 0,
            'absensi' => !empty($req->absensi) ? 1 : 0,
            'daftar_nilai' => !empty($req->daftar_nilai) ? 1 : 0,
            'pelanggaran' => !empty($req->pelanggaran) ? 1 : 0,
            'template' => !empty($req->template) ? 1 : 0,
            'log_user' => !empty($req->log_user) ? 1 : 0,
            'referensi' => !empty($req->referensi) ? 1 : 0,
            'buku_tamu' => !empty($req->buku_tamu) ? 1 : 0,
            'konsultasi' => !empty($req->konsultasi) ? 1 : 0,
            'perpustakaan' => !empty($req->perpustakaan) ? 1 : 0,
            'keuangan' => !empty($req->keuangan) ? 1 : 0,
            'sarana_prasarana' => !empty($req->sarana_prasarana) ? 1 : 0,
            'penerimaan_murid_baru' => !empty($req->penerimaan_murid_baru) ? 1 : 0,
            'ujian_sekolah_berbasis_komputer' => !empty($req->ujian_sekolah_berbasis_komputer) ? 1 : 0,
            'e_voting' => !empty($req->e_voting) ? 1 : 0,
        ]);

       return back()->with(CRUDResponse::successUpdate("sekolah " . $data['name']));
    }

    public function destroy($id) {
        $sekolah    = Sekolah::find($id);

        $role = DB::delete('delete from role_user where user_id = ?', [$id]);
        $user = User::where('id_sekolah', $id)->first()->delete();
        $data = Sekolah::where('id', $id)->first()->delete();
        // check data deleted or not
        if ($data == 1) {
            $success = true;
            $message = "Berhasil Dihapus";
        } else {
            $success = true;
            $message = "Data Tidak Ada";
        }

        return response()
            ->json([
                'success' => '👍 '.$sekolah->name.' berhasil dihapus!',
            ]);
    }
}
