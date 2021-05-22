<?php

namespace App\Http\Controllers\Admin\Pelanggaran;

use Validator;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\PelanggaranSiswa;
use App\Models\Siswa;
use App\Models\Admin\Pelanggaran;
use App\Models\Admin\Sanksi;
use App\Models\Superadmin\Addons;

class SiswaController extends Controller
{ //
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        if ($request->ajax()) {
            $data = PelanggaranSiswa::whereHas('siswa', function($siswa){
                $siswa->whereIn('id', function($user){
                    $user->select('siswa_id')->from('users')->where('id_sekolah', auth()->user()->id_sekolah);
                });
            })->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->addColumn('nama_siswa', function($data){
                    return $data->siswa->nama_lengkap;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $kategori = Pelanggaran::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $sanksi = Sanksi::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $namaSiswa = Siswa::join('users', 'users.siswa_id', 'siswas.id')
                            ->where('id_sekolah', auth()->user()->id_sekolah)
                            ->get('siswas.*');
        // dd($namaSiswa);
        return view('admin.pelanggaran.siswa', ['kategori' => $kategori, 'addons' => $addons, 'sanksi' => $sanksi, 'namaSiswa' => $namaSiswa, 'mySekolah' => User::sekolah()]);
    }

    public function store(Request $request) {
        // validasi
        $rules = [
            'siswa_id'  => 'required|max:50',
        ];

        $message = [
            'siswa_id.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }
        $siswa = Siswa::find($request->siswa_id);
        $siswa->poin += $request->poin;
        $siswa->save();

        $status = PelanggaranSiswa::create([
            'siswa_id' => $request->siswa_id,
            'nama_siswa' => $siswa->nama_lengkap,
            'tanggal_pelanggaran' => $request->tanggal_pelanggaran,
            'pelanggaran' => $request->pelanggaran,
            'poin' => $request->poin,
            'sebab' => $request->sebab,
            'sanksi' => $request->sanksi,
            'penanganan' => $request->penanganan,
            'keterangan' => $request->keterangan
        ]);


        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $pelanggaran_siswa = PelanggaranSiswa::findOrFail($id);
        return response()
            ->json([
                'id' => $pelanggaran_siswa->id,
                'siswa_id'  => $pelanggaran_siswa->siswa_id,
                'nama_siswa'  => $pelanggaran_siswa->nama_siswa,
                'tanggal_pelanggaran'  => $pelanggaran_siswa->tanggal_pelanggaran,
                'pelanggaran'  => $pelanggaran_siswa->pelanggaran,
                'poin'  => $pelanggaran_siswa->poin,
                'sebab'  => $pelanggaran_siswa->sebab,
                'sanksi'  => $pelanggaran_siswa->sanksi,
                'penanganan'  => $pelanggaran_siswa->penanganan,
                'keterangan'  => $pelanggaran_siswa->keterangan
            ]);
        }

    public function update(Request $request) {
        // validasi
        $rules = [
            'siswa_id'  => 'required|max:50',
        ];

        $message = [
            'siswa_id.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $siswa = Siswa::find($request->siswa_id);
        $siswa->poin -= $request->poin_lama;
        $siswa->poin += $request->poin;

        $siswa->save();

        $pelanggaran_siswa = PelanggaranSiswa::findOrFail($request->hidden_id);
        $pelanggaran_siswa->update($request->all());

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $pelanggaran = PelanggaranSiswa::find($id);
        $siswa = Siswa::whereId($pelanggaran->siswa_id)->first();
        $siswa->poin -= $pelanggaran->poin;
        $siswa->save();
        $pelanggaran->delete();
    }

}
