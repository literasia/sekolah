<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SambutanKepsek;
use App\Utils\ApiResponse;

class SambutanController extends Controller
{
    public function getSambutan($sekolah_id){
        $sambutan = SambutanKepsek::where('sekolah_id', $sekolah_id)->first();

        return response()->json(ApiResponse::success(['sambutan' => $sambutan]));
    }
}
