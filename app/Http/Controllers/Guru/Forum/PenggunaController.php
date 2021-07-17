<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User, Role};
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Kelas;
use App\Models\Admin\PenggunaForum;
use App\Models\Admin\RoleForum;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function index(Request $request) {
        $role_forum = RoleForum::orderBy('id','asc')->get();

        if ($request->ajax()) {
            $data = PenggunaForum::orderBy("id","desc")->get();
            return DataTables::of($data)
                ->addIndexColumn()    -
                ->editColumn('username', function($data){
                    return $data->user->username;
                })
                ->editColumn('user_id', function($data){
                    return $data->user->name;
                })
                ->editColumn('kelas_id', function($data){
                    return $data->kelas->name;
                })
                ->make(true);
        }


        return view("guru.forum.pengguna")
                            ->with('role_forum', $role_forum)
                            ->with('mySekolah', User::sekolah());
    }
}
