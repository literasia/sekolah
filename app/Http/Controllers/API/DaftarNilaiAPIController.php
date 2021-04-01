<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\DaftarNilai;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;

class DaftarNilaiAPIController extends Controller
{
    public function nilaiSiswa($id)
    {
        $data = DaftarNilai::where('siswa_id', $id)->get();

        if ($data->count() <= 0) {
            return response()->json(ApiResponse::error('Data tidak ditemukan'));
        }

        return response()->json(ApiResponse::success($data));
    }

    public function nilaiGuru($id)
    {
        $data = DaftarNilai::where('mata_pelajaran_id', $id)->get();

        if ($data->count() <= 0) {
            return response()->json(ApiResponse::error('Data tidak ditemukan'));
        }

        return response()->json(ApiResponse::success($data));
    }
}
