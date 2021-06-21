<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\Materi;

class MateriController extends Controller
{
    public function getMateri($sekolah_id){
        $materi = Materi::where('sekolah_id', $sekolah_id)->get();
        
        $response = ApiResponse::success($materi);
        return response()->json($response);
    }
}
