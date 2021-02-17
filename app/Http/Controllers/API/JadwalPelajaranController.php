<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Helpers\ResponseFormatter;

class JadwalPelajaranController extends Controller
{
    public function read(Request $request) {
        if($request->req == 'table') {
            $data = JadwalPelajaran::with('mataPelajaran')->where('tahun_ajaran', $request->tahun_ajaran)
                                   ->where('kelas', $request->kelas)
                                   ->where('semester', $request->semester)
                                   ->orderBy('jam_pelajaran')
                                   ->get();
            
                                   $data = $data->groupBy('hari');
            
                                   return ResponseFormatter::success([
                                       'senin' => $data['senin'] ?? [],
                                       'selasa' => $data['selasa'] ?? [],
                                       'rabu' => $data['rabu'] ?? [],
                                       'kamis' => $data['kamis'] ?? [],
                                       'jumat' => $data['jumat'] ?? [],
                                       'sabtu' => $data['sabtu'] ?? [],
                                   ]);
        }
    }
}
