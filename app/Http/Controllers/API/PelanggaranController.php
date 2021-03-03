<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\PelanggaranSiswa;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelanggaranController extends Controller
{
    public function index(Request $req) {
        $pelanggarans = PelanggaranSiswa::query();

        $siswaId = $req->query('siswa_id');
        $pelanggarans->when($siswaId, function($query) use ($siswaId) {
            return $query->where('siswa_id', $siswaId);
        });

        return response()->json(ApiResponse::success($pelanggarans->get()));
    }
}
