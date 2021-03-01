<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\Library;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LibraryController extends Controller
{

    public function index(Request $req) {
        $data = $req->all();

        $validator = Validator::make($data, [
            'order_by' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(ApiResponse::validationError($validator->errors()));
        }

        $libraries = Library::query()->with(['kategori', 'penulis']);

        $sekolahId = $req->query('sekolah_id');
        $libraries->when($sekolahId, function($query) use ($sekolahId) {
            return $query->where('sekolah_id', $sekolahId)
                ->orWhereNull('sekolah_id');
        });

        $kategoriId = $req->query('kategori_id');
        $libraries->when($kategoriId, function($query) use ($kategoriId) {
            return $query->where('kategori_id', $kategoriId);
        });

        $q = $req->query('q');
        $libraries->when($q, function($query) use ($q) {
            return $query->whereRaw("name LIKE '%" . strtolower($q) . "%'");
        });

        $orderBy = $data['order_by'];
        switch ($orderBy) {
            case "popular":
                $libraries = $libraries->orderByDesc('viewed')
                    ->orderBy('name')
                    ->limit(30);
                break;
            default:
                $libraries = $libraries->orderBy('name')->limit(30);
        }

        $libraries = $libraries->get();
        return response()->json(ApiResponse::success($libraries));
    }
}
