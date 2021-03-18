<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Helpers\ResponseFormatter;

class JadwalPelajaranController extends Controller
{
    public function read(Request $request, $id)
    {

        $data = JadwalPelajaran::join('mata_pelajarans', 'jadwal_pelajarans.mata_pelajaran_id', 'mata_pelajarans.id')->join('jam_pelajarans', 'jadwal_pelajarans.jam_pelajaran', 'jam_pelajarans.jam_ke')->join('gurus', 'gurus.id', 'mata_pelajarans.guru_id')->join('kelas', 'jadwal_pelajarans.kelas_id', 'kelas.id')
            ->where('mata_pelajarans.sekolah_id', $id)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->where('kelas_id', $request->kelas_id)
            ->where('semester', $request->semester)
            ->where('jadwal_pelajarans.hari', 'senin')
            ->where('gurus.id', 2)
            ->orderBy('jam_pelajaran')
            ->get();


        // ['jadwal_pelajarans.jam_pelajaran', 'jadwal_pelajarans.semester', 'kelas.name AS nama_kelas']
        return ResponseFormatter::success([
            // 'senin' => $data['senin'] ?? [],
            // 'selasa' => $data['selasa'] ?? [],
            // 'rabu' => $data['rabu'] ?? [],
            // 'kamis' => $data['kamis'] ?? [],
            // 'jumat' => $data['jumat'] ?? [],
            // 'sabtu' => $data['sabtu'] ?? [],
            $data
        ]);
    }
}
