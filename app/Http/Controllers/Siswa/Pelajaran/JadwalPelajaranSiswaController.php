<?php

namespace App\Http\Controllers\Siswa\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{JadwalPelajaran, JamPelajaran, MataPelajaran, TingkatanKelas, Semester};
use App\Models\Admin\Kelas;
use App\User;
use App\Models\Superadmin\Sekolah;

class JadwalPelajaranSiswaController extends Controller
{

    public function index(Request $request) {
        $data = null;
        $sekolah = Sekolah::findOrFail(auth()->user()->id_sekolah);
        
        $tahun_ajaran = $request->tahun_ajaran;
        $kelas_id = $request->kelas_id;
        $semester = $request->semester;

        if($request->req == 'table') {
            $data = JadwalPelajaran::with('mataPelajaran')
                                   ->where('tahun_ajaran', $tahun_ajaran)
                                   ->where('kelas_id', $kelas_id)
                                   ->where('semester', $semester)
                                   ->orderBy('jam_pelajaran')
                                   ->get();

            $data = $data->groupBy('hari');

        }elseif($request->req == 'single') {
            $obj = JadwalPelajaran::findOrFail($request->id);
            return response()->json($obj);
        }

        $kelas = Kelas::where('user_id', $request->user()->id)->get();
        $pelajaran = MataPelajaran::join('gurus', 'gurus.id', 'guru_id')
                                    ->join('pegawais', 'pegawais.id', 'gurus.pegawai_id')
                                    ->where('sekolah_id', $request->user()->id_sekolah)
                                    ->selectRaw('mata_pelajarans.id, concat(nama_pelajaran, " | ", name) as name')->get();

        return view('siswa.pelajaran.jadwal-pelajaran', compact('kelas_id', 'sekolah', 'semester', 'kelas', 'tahun_ajaran', 'data', 'pelajaran'));
    }
    
}
