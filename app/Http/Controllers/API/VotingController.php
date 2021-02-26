<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\Pemilihan;
use App\Models\Admin\Posisi;
use App\Models\Admin\Voting;
use App\Models\Admin\Calon;
use App\Models\Admin\CalonPemilihan;

class VotingController extends Controller
{
    public function index(Request $req) {
        $voting = Pemilihan::query();
        $sekolahId = $req->query('sekolah_id');
        $posisi = $req->query('posisi');
        $voting->when($sekolahId, function($query) use ($sekolahId) {
            return $query->where('sekolah_id', $sekolahId);
        });
        $voting->when($posisi, function($query) use ($posisi) {
            return $query->where('posisi', $posisi);
        });
        $voting = $voting->whereRaw("CURRENT_DATE BETWEEN start_date AND end_date")->orderBy('name')->get();

        return response()->json(ApiResponse::success($voting));
    }

    public function posisiKandidat(Request $req) {
        $data = $req->all();
        $hasVote = Voting::where('id_user', $data['user_id'])->count();
        if ($hasVote > 0) {
            $this->hasilVoting($req);
            return;
        }

        $calonPemilihan = CalonPemilihan::query();
        $pemilihanId = $req->query('pemilihan_id');
        $calonPemilihan->when($pemilihanId, function($query) use ($pemilihanId) {
            return $query->where('pemilihan_id', $pemilihanId);
        });
        
        return response()->json(ApiResponse::success($calonPemilihan->calons()->orderBy('name')->get()));
    }

    public function hasilVoting(Request $request){
        $data = $request->all();

        $jumlahsuara = Voting::all();
        $names = Pemilihan::where('pemilihan_id', $data['pemilihan_id'])->orderBy('id')->get();
        // $calon = CalonPemilihan::all();
        $pemilihans = Pemilihan::orderBy('posisi')->get();
        $counts = collect();
        // dd($names[0]->votes);
        // exit();

        foreach($names as $nc){
            foreach ($nc->calons as $calon){
                $hasil = Voting::where(['pemilihan_id'=>$nc->id, 'calon_id' => $calon->id])->count();
                $counts->push(['name'=>$calon->name, 'total'=>$hasil]);
            }
                return response()->json(ApiResponse::success($counts));
        }


        // foreach ($names as $nc){
        //     // foreach($nc->calons as $calon){
        //     //     $hasil = Voting::where(['pemilihan_id'=>$nc->id, 'calon_id' => $calon->id])->count();
        //     //     $counts->push(['name' => $calon->name, 'total' => $hasil]);
        //     //     return response()->json(ApiResponse::success($counts));
        //     // }
        //         echo $nc->id;
        // }

        // foreach ($names as $calon){
        //         // $hasil = Voting::where(['pemilihan_id'=>$calon->id, 'calon_id' => $calon->id])->count();
        //         $counts->push(['name' => $calon->name]);
        //         return response()->json(ApiResponse::success($counts));
        // }
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
            ['pemilihan_id', $data['pemilihan_id']],
            ['id_user', $data['user_id']]
        ])->exists();

        if ($exist) {
            $this->hasilVoting($req);
            return;
        }

        Voting::create([
            'pemilhan_id' => $data['pemilihan_id'],
            'calon_id' => $data['calon_id'],
            'id_user' => $data['user_id']
        ]);

        return response()->json(ApiResponse::success([], "Berhasil vote"));
    }
}