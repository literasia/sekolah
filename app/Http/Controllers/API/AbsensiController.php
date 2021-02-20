<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Siswa;

class AbsensiController extends Controller
{
    public function read(Request $request) {
        if($request->req == 'table') {
            $data = Siswa::with(['kelas', 
                                 'absensi' => function($q) use($request){
                                     $q->where('tanggal', $request->tanggal)->where('kelas_id', $request->kelas_id);
                                }])
                         ->where('id_tingkatan_kelas', $request->kelas_id)
                         ->orderBy('nama_lengkap')
                         ->get();
            
                         return ResponseFormatter::success($data);
        }

        elseif($request->req == 'rekap') {
            $data = Siswa::where('id_tingkatan_kelas', $request->kelas_id)
                        ->with('kelas')
                        ->orderBy('nama_lengkap')
                         ->with(['absensis' => function($q) use($request){
                             $q->where('tanggal', '>=', $request->tanggal_mulai)
                               ->where('tanggal', '<=', $request->tanggal_selesai);
                         }])->get();
                         
                         return ResponseFormatter::success($data);
        }
    }
}
