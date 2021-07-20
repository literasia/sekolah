<?php

namespace App\Http\Controllers\Admin\Forum;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Forum;
use App\Models\Admin\Topik;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Forum::where('sekolah_id', auth()->user()->id_sekolah)->orderBy("id","desc")->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('topik_id', function($data){
                    return $data->topik->judul;
                })
                ->editColumn('user_id', function($data){
                    return $data->user->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // $user = $request->user;
        $topiks = Topik::all();
        $users = User::all();
        $forums = Forum::all();

        return view('guru.forum.dashboard',  ['mySekolah' => User::sekolah(), 'topiks' => $topiks, 'users' => $users]);
    }
}
