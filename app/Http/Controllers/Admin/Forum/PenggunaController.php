<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Kelas;
use App\Models\Admin\PenggunaForum;

class PenggunaController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        if ($request->ajax()) {
            $data = PenggunaForum::orderBy("id","desc")->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('username', function($data){
                    return $data->user->username;
                })
                ->editColumn('user_id', function($data){
                    return $data->user->name;
                })
                ->editColumn('kelas_id', function($data){
                    return $data->kelas->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view("admin.forum.pengguna")->with('addons', $addons)
                                        ->with('mySekolah', User::sekolah());
    }
}
