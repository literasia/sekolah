<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\Pemilihan;

class VotingController extends Controller
{
    public function index(Request $req) {
        $voting = Pemilihan::query();
        // $sekolahId = $req->query('sekolah_id');
        // $voting->get($sekolahId, function($query) use ($sekolahId) {
        //     return $query->where('sekolah_id', $sekolahId);
        // });
        $voting = $voting->whereRaw("CURRENT_DATE BETWEEN start_date AND end_date")->orderBy('name')->get();

        return response()->json(ApiResponse::success($voting));
    }
}