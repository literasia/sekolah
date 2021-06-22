<?php

namespace App\Http\Controllers\Admin\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Admin\{Ranking,Kelas,Ujian};
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->kelas_id;
        $siswa = $request->siswa_id;
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $kelas = Kelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        $ranking = Ranking::all();
        
        if ($request->ajax())
        {
            // $ranking = Ranking::whereHas('ranking', function($query){
            //     $query->where('sekolah_id', auth()->user()->id_sekolah);
            // });
    
            if (!empty($request->kelas_id)) {
                $kelas_id = $request->kelas_id;
                $ranking->whereHas('ranking', function($query) use($kelas_id){
                    $query->where('kelas_id', $kelas_id);
                });
            }
    
            if (!empty($request->siswa_id)) {
                $ranking->where('siswa_id', $request->siswa_id);
            }

            $ranking = $ranking->get();
    
            return DataTables::of($ranking)
                ->addColumn('action', function ($ranking) {
                    $button = '<button type="button" data-id="'.$ranking->id.'" class="preview btn btn-mini btn-warning shadow-sm"><i class="fa fa-eye"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$ranking->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$ranking->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('ranking', function ($ranking){
                    return $ranking->ranking;
                })
                ->addColumn('siswa', function ($ranking){
                    return $ranking->siswa->nama;
                })
                ->addColumn('ujian', function ($ranking){
                    return $ranking->ujians->wak;
                })
                
                ->rawColumns(['action', 'jenis_soal'])
                ->addIndexColumn()
                ->make(true);
        }
        // return view('admin.cbt.ranking',['mySekolah' => User::sekolah(), 'addons' => $addons]);
        

    
        return view('admin.cbt.ranking')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('kelas', $kelas)
                                    ->with('kelas_id', $kelas_id)
                                    ->with('ranking', $ranking)
                                    ->with('addons', $addons); 
    }

    public function store(Request $request){

        //
    }

    public function update(Request $request){
        //
}

}