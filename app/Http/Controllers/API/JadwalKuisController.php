<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Kuis;
use App\Utils\ApiResponse;

class JadwalKuisController extends Controller
{
    public function getJadwalKuis($sekolah_id){
        $kuis = Kuis::where('sekolah_id', $sekolah_id)->get();
        
        $response = ApiResponse::success($kuis);
        return response()->json($response);
    }
}
