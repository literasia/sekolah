<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\BankSoal;
use App\Models\Admin\BankButirSoal;

class BankSoalController extends Controller
{
    public function getBankSoal($sekolah_id){
        $soal = BankSoal::where('sekolah_id', $sekolah_id)->get();
        
        $response = ApiResponse::success($soal);
        return response()->json($response);
    }
   public function getButirSoal(BankSoal $bank_soal){
        $soal = BankSoal::where('id', $bank_soal->id)->first();
        $butirsoal = BankButirSoal::where('soal_id', $bank_soal->id)->get();
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
