<?php

namespace App\Http\Controllers\Superadmin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Superadmin\Provinsi;
use App\Models\Superadmin\KabupatenKota;
use App\Models\Admin\Access;
use App\Models\Superadmin\{Addons, Sekolah};
use App\Models\Siswa;

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
        $sekolah = Sekolah::all();
$tahun_ajaran = $request->tahun_ajaran;


        return view('superadmin.list-sekolah',compact('sekolah', 'tahun_ajaran'), ['provinsis' => $provinsis, 'kabupaten' => $kabupaten, 'sekolahs' => $sekolah]);
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
            // 'logo'          => ['nullable', 'mimes:jpeg,jpg,png,svg', 'max:2000 ']
        ];

        $message = [
            'id_sekolah.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($data, $rules, $message);

        // Validation rules
        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        // Add Sekolah
        $sekolah = Sekolah::create([
            'id_sekolah'    => $data['id_sekolah'],
            'name'          => $data['name'],
            'alamat'        => $data['alamat'],
            'provinsi'      => $data['provinsi'],
            'kabupaten'     => $data['kabupaten'],
            'jenjang'       => $data['jenjang'],
            'tahun_ajaran'  => $data['tahun_ajaran'],
            // 'logo'          => $data['logo']
        ]);
    
        
        // Get Roles
        $adminRole = Role::where('name', 'admin')->first();

        $user = User::create([
            'id_sekolah'    => $sekolah->id,
            'role_id'       => $adminRole->id,
            'name'          => $data['name'],
            'username'      => $data['username'],
            'password'      => Hash::make($data['password'])
        ]);

        // Attach to Role User
        $user_id = User::findOrFail($user->id);
        $user_id->roles()->attach($adminRole->id);
        
        // Add Addons
        Addons::create([
            'sekolah_id' => $sekolah->id,
            'user_id' => $user->id,
            'referensi' => !empty($req->referensi) ? 1 : 0,
            'sekolah' => !empty($req->sekolah) ? 1 : 0,
            'fungsionaris' => !empty($req->fungsionaris) ? 1 : 0,
            'pelajaran' => !empty($req->pelajaran) ? 1 : 0,
            'peserta_didik' => !empty($req->peserta_didik) ? 1 : 0,
            'absensi' => !empty($req->absensi) ? 1 : 0,
            'e_learning' => !empty($req->e_learning) ? 1 : 0,
            'daftar_nilai' => !empty($req->daftar_nilai) ? 1 : 0,
            'e_rapor' => !empty($req->e_rapor) ? 1 : 0,
            'pelanggaran' => !empty($req->pelanggaran) ? 1 : 0,
            'e_voting' => !empty($req->e_voting) ? 1 : 0,
            'kalender' => !empty($req->kalender) ? 1 : 0,
            'import' => !empty($req->import) ? 1 : 0,
            'perpustakaan' => !empty($req->perpustakaan) ? 1 : 0,
            'forum' => !empty($req->forum) ? 1 : 0,
            'leaderboard' => !empty($req->leaderboard) ? 1 : 0,
            'cbt' => !empty($req->cbt) ? 1 : 0,
            'pengumuman' => !empty($req->pengumuman) ? 1 : 0,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
        ]);
    }

    public function edit($id) {
        $sekolah = Sekolah::findOrFail($id);
        $provinsi = Provinsi::findOrFail($sekolah->provinsi);
        $kabupaten = KabupatenKota::findOrFail($sekolah->kabupaten);

        // get Addons
        $addons = Addons::where('sekolah_id', $sekolah->id)->first();

        // get User
        $user = User::where('id_sekolah', $sekolah->id)->first();

        return response()
            ->json([                
                'id'   => $sekolah->id,
                'id_sekolah'   => $sekolah->id_sekolah,
                'username' => $user->username,                
                'name'   => $sekolah->name,
                'alamat'   => $sekolah->alamat,
                'provinsi'   => $provinsi->id,
                'kabupaten'   => $kabupaten->id,
                'jenjang'   => $sekolah->jenjang,
                'tahun_ajaran'   => $sekolah->tahun_ajaran,
                'user'      =>  User::where('id_sekolah', $sekolah->id)->first(),
                'referensi' => $addons->referensi,
                'sekolah' => $addons->sekolah,
                'fungsionaris' => $addons->fungsionaris,
                'pelajaran' => $addons->pelajaran,
                'peserta_didik' => $addons->peserta_didik,
                'absensi' => $addons->absensi,
                'forum' => $addons->forum,
                'leaderboard' => $addons->leaderboard,
                'e_learning' => $addons->e_learning,
                'daftar_nilai' => $addons->daftar_nilai,
                'e_rapor' => $addons->e_rapor,
                'pelanggaran' => $addons->pelanggaran,
                'e_voting' => $addons->e_voting,
                'kalender' => $addons->kalender,
                'import' => $addons->import,
                'perpustakaan' => $addons->perpustakaan,
                'cbt' => $addons->cbt,
                'pengumuman' => $addons->pengumuman,
            ]);
    }

    public function update(Request $req) {
        $data = $req->all();
        $id = $data['hidden_id'];
        
        $sekolah = Sekolah::findOrFail($id);

        $rules = [
           'id_sekolah'    => 'max:100',
           'name'          => 'required|max:100',
           'alamat'        => 'required',
           'provinsi'        => 'required',
           'kabupaten'        => 'required',
           'jenjang'       => 'required',
           'tahun_ajaran'  => 'required',
           'password_baru' => 'required_with:password_confirmation',
           'password_confirmation' => 'same:password_baru'
        ];

        // get user
        $user = User::where('id_sekolah', $sekolah->id)->first();
    
        // $message = [
        //     'id_sekolah.required' => 'Kolom ini gaboleh kosong',
        // ];

        $validator = Validator::make($data, $rules);

        // Validation Rules
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        // Change User Password
        if (!empty($req->password_lama)) {
            if (Hash::check($req->password_lama, $user->password)) {
                $user->update([
                    'password' => Hash::make($req->password_baru)
                ]);
            }
            else{
                return response()->json([
                    'error_old_password' => true
                ]);
            }
        }

        $sekolah->update([
            'id_sekolah'    => $data['id_sekolah'],
            'name'          => $data['name'],
            'alamat'        => $data['alamat'],
            'provinsi'        => $data['provinsi'],
            'kabupaten'        => $data['kabupaten'],
            'jenjang'       => $data['jenjang'],
            'tahun_ajaran'  => $data['tahun_ajaran'],
            // 'logo'          => $data['logo']
        ]);

        // Get Addons
        $addons = Addons::where('sekolah_id', $data['hidden_id'])->first();
        
        // Get User
        $user = User::where('id_sekolah', $sekolah->id)->first();

        // Update Addons Sekolah
        $addons->update([
            'sekolah_id' => $data['hidden_id'],
            'user_id' => $user->id,
            'referensi' => !empty($req->referensi) ? 1 : 0,
            'sekolah' => !empty($req->sekolah) ? 1 : 0,
            'fungsionaris' => !empty($req->fungsionaris) ? 1 : 0,
            'pelajaran' => !empty($req->pelajaran) ? 1 : 0,
            'peserta_didik' => !empty($req->peserta_didik) ? 1 : 0,
            'absensi' => !empty($req->absensi) ? 1 : 0,
            'e_learning' => !empty($req->e_learning) ? 1 : 0,
            'daftar_nilai' => !empty($req->daftar_nilai) ? 1 : 0,
            'e_rapor' => !empty($req->e_rapor) ? 1 : 0,
            'pelanggaran' => !empty($req->pelanggaran) ? 1 : 0,
            'e_voting' => !empty($req->e_voting) ? 1 : 0,
            'kalender' => !empty($req->kalender) ? 1 : 0,
            'import' => !empty($req->import) ? 1 : 0,
            'perpustakaan' => !empty($req->perpustakaan) ? 1 : 0,
            'forum' => !empty($req->forum) ? 1 : 0,
            'leaderboard' => !empty($req->leaderboard) ? 1 : 0,
            'cbt' => !empty($req->cbt) ? 1 : 0,
            'pengumuman' => !empty($req->pengumuman) ? 1 : 0,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
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

    public function generate(){
        $list_sekolah = Sekolah::get();
        
        foreach ($list_sekolah as $item) {
            // get Roles to attach user roles
            $role = Role::where('name', 'admin')->first();

            $user = User::create([
                'role_id' => $role->id,
                'name' => 'admin-'.$item->name, //admin-smkn2
                'username' => 'admin-'.$item->id_sekolah, //admin-0941231 
                'email' => $item->name.'@gmail.com', // smk2@gmail.com
                'id_sekolah' => $item->id, // sekolah_id
                'password' => Hash::make('belajarterus'), //admin-0941231 (admin-idsekolah)
            ]);

            $user_id = User::findOrFail($user->id);

            // attach
            $user_id->roles()->attach($role->id);

            $addons = Addons::where('sekolah_id', $item->id);

            $addons->update([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back();
    }

    public function generateSiswa(){
        $sekolah = Sekolah::get();
        
        foreach ($sekolah as $data_sekolah) {
            foreach ($siswa as $item) {
                // get Roles to attach user roles
                $role = Role::where('name', 'siswa')->first();

                $user = User::create([
                    'role_id' => $role->id,
                    'siswa_id' => $item->id,
                    'name' => $item->nama_lengkap, //admin-smkn2
                    'username' => $item->nisn, 
                    'nis' => $item->nis,//admin-0941231 
                    'id_sekolah' => $data_sekolah->id, // sekolah_id
                    'password' => Hash::make('belajarterus'), //admin-0941231 (admin-idsekolah)
                ]);

                $user_id = User::findOrFail($user->id);
                // attach
                $user_id->roles()->attach($role->id);
            }
        }

        return redirect()->back();
    }

    
}