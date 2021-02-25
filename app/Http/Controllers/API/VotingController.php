<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\Pemilihan;
use App\Models\Admin\Posisi;
use App\Models\Admin\Voting;

class VotingController extends Controller
{
    public function index(Request $req) {
        $voting = Pemilihan::query();
        $sekolahId = $req->query('sekolah_id');
        $posisi = $req->query('posisi');
        // $voting->when($sekolahId, function($query) use ($sekolahId) {
        //     return $query->where('sekolah_id', $sekolahId);
        // });
        $voting->when($posisi, function($query) use ($posisi) {
            return $query->where('posisi', $posisi);
        });
        $voting = $voting->whereRaw("CURRENT_DATE BETWEEN start_date AND end_date")->orderBy('name')->get();

        return response()->json(ApiResponse::success($voting));
    }

    public function posisiKandidat(Request $req) {
        $kandidats = Posisi::query();
        $sekolahId = $req->query('sekolah_id');
        // $voting->get($sekolahId, function($query) use ($sekolahId) {
        //     return $query->where('sekolah_id', $sekolahId);
        // });
        $kandidats = $kandidats->orderBy('name')->get();
        return response()->json(ApiResponse::success($kandidats));
    }

    public function hasilVoting(Request $request){
        $jumlahsuara = Voting::all();
        $names = Pemilihan::orderBy('start_date')->get();
        $pemilihans = Pemilihan::orderBy('posisi')->get();
        $counts = collect();
        // dd($names[0]->votes);

        $a = [];

        foreach ($names as $nc) {
           $a->push(['name' => $nc->calons->name, 'total' => $nc->calons->id]);
        }

        // foreach($names as $nc){
        //     foreach ($nc->calons as $calon){
        //         $hasil = Voting::where(['pemilihan_id'=>$nc->id, 'calon_id' => $calon->id])->count();
        //         foreach($counts as $count){
        //             $counts->push($hasil);
        //         }
        //             return response()->json(ApiResponse::success($counts));
        //     }
        // }
    }

    public function store(Request $req) {
        $data = $req->all();

        $exist = Voting::where([
            ['calon_id', $data['calon_id']],
            ['id_user', $data['user_id']]
        ])->exists();

        if ($exist) {
            return response()->json(ApiResponse::error('Anda sudah pernah voting kandidat ini'));
        }

        Voting::create([
            'calon_id' => $data['calon_id'],
            'id_user' => $data['user_id']
        ]);

        return response()->json(ApiResponse::success([], "Berhasil vote"));
    }
}