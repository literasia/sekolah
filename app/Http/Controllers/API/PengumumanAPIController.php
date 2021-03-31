<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Pesan;
use App\Utils\ApiResponse;

class PengumumanAPIController extends Controller
{
    public function getPesan($sekolah_id)
    {
        $pesan = Pesan::where('user_id', $sekolah_id)->get();

        return response()->json(ApiResponse::success($pesan, 'Pengambilan data berhasil'));
    }
}
