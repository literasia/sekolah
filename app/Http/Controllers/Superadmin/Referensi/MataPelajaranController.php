<?php

namespace App\Http\Controllers\Superadmin\Referensi;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Guru;
use App\Models\Superadmin\ReferensiMataPelajaran;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class MataPelajaranController extends Controller
{
    public function index(Request $request) { 
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $mapel = ReferensiMataPelajaran::all();
        if ($request->ajax()){
            $mapel = ReferensiMataPelajaran::latest()->get();
            return DataTables::of($mapel)
                ->addIndexColumn()
                ->addColumn('action', function($mapel){
                    $button = '<button type="button" data-id="'.$mapel->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$mapel->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('nama_pelajaran', function($mapel){
                    return $mapel->nama_pelajaran;
                })
                ->rawColumns(['action'])
                    ->make(true);
        }
        return view('superadmin.referensi.matapelajaran')
                                                ->with('mySekolah', User::sekolah())
                                                ->with('addons', $addons)
                                                ->with('mapel',$mapel);
    }

    public function write(Request $request) {
        if($request->req == 'write') {
            $obj = ReferensiMataPelajaran::find($request->id);

            if(!$obj){
                $obj = new ReferensiMataPelajaran();
            }

            $obj->nama_pelajaran = $request->nama_pelajaran;
            $obj->save();
            return response()->json($obj);


        }
        elseif($request->req == 'delete') {
            ReferensiMataPelajaran::find($request->id)->delete();
        }
    }
}
