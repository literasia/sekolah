<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Models\Guru;
use App\Helpers\ResponseFormatter;

class MapelGuruController extends Controller
{
    public function read(Request $request)
    {

        $data = JadwalPelajaran::join('mata_pelajarans', 'jadwal_pelajarans.mata_pelajaran_id', 'mata_pelajarans.id')->where('tahun_ajaran', $request->tahun_ajaran)
                ->where('mata_pelajarans.guru_id', $request->guru_id)
                ->where('semester', $request->semester)
                ->orderBy('jam_pelajaran')
                ->get();

            $data = $data->groupBy('hari');

            return ResponseFormatter::success([
                'senin'  => $data['senin'] ?? [],
                'selasa' => $data['selasa'] ?? [],
                'rabu'   => $data['rabu'] ?? [],
                'kamis'  => $data['kamis'] ?? [],
                'jumat'  => $data['jumat'] ?? [],
                'sabtu'  => $data['sabtu'] ?? [],
            ]);
    }
}
