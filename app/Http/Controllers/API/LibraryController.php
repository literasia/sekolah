<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\Library;
use App\Models\Pinjam;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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

        $filterType = $req->query('filter_type');
        $filterFunc = null;
        if ($filterType == 'ebook') {
            $filterFunc = function($query) {
                return $query->whereNotNull('link_ebook')->where('link_ebook', '!=', '');
            };
        } else if ($filterType == 'audio') {
            $filterFunc = function($query) {
                return $query->whereNotNull('link_audio')->where('link_audio', '!=', '');
            };
        } else if ($filterType == 'video') {
            $filterFunc = function($query) {
                return $query->whereNotNull('link_video')->where('link_video', '!=', '');
            };
        }

        if ($filterFunc != null) {
            $libraries->when($filterType, $filterFunc);
        }

        $skipData = ((empty($data['page']) ? 1 : $data['page']) - 1) * 30;

        $orderBy = $data['order_by'];
        switch ($orderBy) {
            case "popular":
                $libraries = $libraries->orderByDesc('viewed')
                    ->orderBy('name')
                    ->skip($skipData)
                    ->take(30);
                break;
            default:
                $libraries = $libraries->orderBy('name')->limit(30);
        }

        $libraries = $libraries->get();
        return response()->json(ApiResponse::success($libraries));
    }

    public function getPinjam($id, Request $request)
    {
        if ($request->library_id) {
            $data = Pinjam::join('siswas', 'pinjams.siswa_id', 'siswas.id')
                            ->join('libraries', 'pinjams.library_id', 'libraries.id')
                            ->where('pinjams.siswa_id', $id)
                            ->where('pinjams.library_id', $request->library_id)
                            ->get('pinjams.*');
        }else{
            $data = Pinjam::join('siswas', 'pinjams.siswa_id', 'siswas.id')
                            ->join('libraries', 'pinjams.library_id', 'libraries.id')
                            ->where('pinjams.siswa_id', $id)
                            ->get('pinjams.*');
        }

        return response()->json(ApiResponse::success($data));
    }

    public function addPinjam($id, Request $request)
    {
        // $req = $request->all();
        // Validator::make($req, [
        //     'ebook_expired_at' => ['nullable'],
        //     'audio_expired_at' => ['nullable'],
        //     'video_expired_at' => ['nullable']
        // ]);
        // dd(Carbon::now()->format('m'));
        $pinjam  = Pinjam::where('siswa_id', $id)->latest()->get('total_pinjam');

        if ($pinjam->count() <= 0) {
            $pinjam = 1;
            $data = Pinjam::create([
                'siswa_id' => $id,
                'library_id' => $request->library_id,
                'ebook_expired_at' => $request->ebook_expired_at,
                'audio_expired_at' => $request->audio_expired_at,
                'video_expired_at' => $request->video_expired_at,
                'total_pinjam' => $pinjam
            ]);
            return response()->json(ApiResponse::success($data, "Peminjaman Berhasil"));
        } else {
            $pinjam = $pinjam[0]->total_pinjam + 1;
            $data = Pinjam::where('siswa_id', $id)->where('library_id', $request->library_id)
                ->update([
                    'ebook_expired_at' => $request->ebook_expired_at,
                    'audio_expired_at' => $request->audio_expired_at,
                    'video_expired_at' => $request->video_expired_at,
                    'total_pinjam' => $pinjam
                ]);

            if ($data) {
                return response()->json(ApiResponse::success($data, "Peminjaman Berhasil"));
            } else {

                $data = Pinjam::create([
                    'siswa_id' => $id,
                    'library_id' => $request->library_id,
                    'ebook_expired_at' => $request->ebook_expired_at,
                    'audio_expired_at' => $request->audio_expired_at,
                    'video_expired_at' => $request->video_expired_at,
                    'total_pinjam' => $pinjam
                ]);
                return response()->json(ApiResponse::success($data, "Peminjaman Berhasil"));
            }
        }
    }
}
