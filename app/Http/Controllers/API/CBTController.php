<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\CbtSoal;
use App\Models\Admin\CbtButirSoal;

class CBTController extends Controller
{
    public function getSoalUjian($sekolah_id){
        $soal = CbtSoal::where('sekolah_id', $sekolah_id)->get();
        
        $response = ApiResponse::success($soal);
        return response()->json($response);
    }

    public function getButirSoal(CbtSoal $cbt_soal){
        $soal = CbtSoal::where('id', $cbt_soal->id)->first();
        $butirsoal = CbtButirSoal::where('soal_id', $cbt_soal->id)->get();
        $butir_soal = [];
        
        foreach ($butirsoal as $item) {
            $opsi = explode("|literasia_sekolah|", $item->jawaban);
            
            // push to items
            $items = [
                "id" => $item->id,
                "pertanyaan" => $item->pertanyaan,
                "kunci_jawaban" => $item->kunci_jawaban,
                "jawaban" => $opsi
            ];

            // push to butir_soal
            array_push($butir_soal, $items);
        }
        
        return response()->json([
            'soal' => $soal,
            'butir_soal' => $butir_soal
        ]);
    }

}
