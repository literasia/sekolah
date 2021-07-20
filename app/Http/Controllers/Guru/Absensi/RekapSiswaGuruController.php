<?php

namespace App\Http\Controllers\Guru\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kelas;
use Illuminate\Http\Request;
use App\Models\{Guru, Siswa};
use App\Models\TingkatanKelas;

class RekapSiswaGuruController extends Controller
{
    public function index(Request $request) {
        $data = [];
        if($request->req == 'table') {
            $data = Siswa::where('kelas_id', $request->kelas_id)
                        ->with('kelas')
                        ->orderBy('nama_lengkap')
                         ->with(['absensis' => function($q) use($request){
                             $q->where('tanggal', '>=', $request->tanggal_mulai)
                               ->where('tanggal', '<=', $request->tanggal_selesai);
                         }])->get();

            //return response()->json($data);
        }

        // get data guru
        $guru = Guru::where('user_id', auth()->user()->id)->first();

        $kelas = Kelas::where('pegawai_id', $guru->pegawai->id)->get();

        return view('guru.absensi.rekap-siswa', compact('data', 'kelas'));
    }
}
