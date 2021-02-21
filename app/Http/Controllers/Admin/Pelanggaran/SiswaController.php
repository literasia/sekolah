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

class SiswaController extends Controller
{
    public function index(Request $request) {
    	if ($request->ajax()) {
            $data = PelanggaranSiswa::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $kategori = Pelanggaran::all();
        $sanksi = Sanksi::all();
    	$namaSiswa = Siswa::all();
        return view('admin.pelanggaran.siswa', ['kategori' => $kategori, 'sanksi' => $sanksi, 'namaSiswa' => $namaSiswa, 'mySekolah' => User::sekolah()]);
    }

    public function store(Request $request) {
        // validasi
        $rules = [
            'nama_siswa'  => 'required|max:50',
        ];

        $message = [
            'nama_siswa.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }
        $siswa = Siswa::find($request->input('siswa_id'));
        $siswa->poin += $request->input('poin');
        $siswa->save();

        $status = PelanggaranSiswa::create([
            'siswa_id' => $request->input('siswa_id'),
            'nama_siswa' => $siswa->nama_lengkap,
            'tanggal_pelanggaran' => $request->input('tanggal_pelanggaran'),
            'pelanggaran' => $request->input('pelanggaran'),
            'poin' => $request->input('poin'),
            'sebab' => $request->input('sebab'),
            'sanksi' => $request->input('sanksi'),
            'penanganan' => $request->input('penanganan'),
            'keterangan' => $request->input('keterangan')
        ]);


        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $nama_siswa = PelanggaranSiswa::find($id);
        $tanggal_pelanggaran = PelanggaranSiswa::find($id);
        $pelanggaran = PelanggaranSiswa::find($id);
        $poin = PelanggaranSiswa::find($id);
        $sebab = PelanggaranSiswa::find($id);
        $sanksi = PelanggaranSiswa::find($id);
        $penanganan = PelanggaranSiswa::find($id);
        $keterangan = PelanggaranSiswa::find($id);

        return response()
            ->json([
                'nama_siswa'  => $nama_siswa,
                'tanggal_pelanggaran'  => $tanggal_pelanggaran,
                'pelanggaran'  => $pelanggaran,
                'poin'  => $poin,
                'sebab'  => $sebab,
                'sanksi'  => $sanksi,
                'penanganan'  => $penanganan,
                'keterangan'  => $keterangan
            ]);
        }

    public function update(Request $request) {
        // validasi
        $rules = [
            'nama_siswa'  => 'required|max:50',
        ];

        $message = [
            'nama_siswa.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = PelanggaranSiswa::whereId($request->input('hidden_id'))->update([
            'nama_siswa'  			=> $request->input('nama_siswa'),
            'tanggal_pelanggaran'  	=> $request->input('tanggal_pelanggaran'),
            'pelanggaran'  			=> $request->input('pelanggaran'),
            'poin'  				=> $request->input('poin'),
            'sebab'  				=> $request->input('sebab'),
            'sanksi'  				=> $request->input('sanksi'),
            'penanganan'  			=> $request->input('penanganan'),
            'keterangan'  			=> $request->input('keterangan')
        ]);

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $sanksi = PelanggaranSiswa::find($id);
        $sanksi->delete();
    }

}
