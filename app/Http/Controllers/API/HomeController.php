<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\Library;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class HomeController extends Controller
{
    public function index(Request $req) {
        $data = $req->all();

        $libraries = Library::query()->with(['kategori', 'penulis']);
        
        $sekolahId = $req->query('sekolah_id');
        $libraries->when($sekolahId, function($query) use ($sekolahId) {
            return $query->where('sekolah_id', $sekolahId)
                ->orWhereNull('sekolah_id');
        });

        $libraries = $libraries->orderByDesc('created_at')->limit(10)->get();
        $banners = [];
        for($i=0;$i<4;$i++) {
            $banners[$i] = [
                'id' => $i,
                'img' => 'kosong'
            ];
        }

        $akses = User::find($data['user_id'])->pegawai->access ?? null;

        $data = [
            'banners' => $banners,
            'newestLibraries' => $libraries,
            'akses' => $akses
        ];

        return response()->json(ApiResponse::success($data));
    }
}
