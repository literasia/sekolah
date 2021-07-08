<?php

namespace App\Http\Controllers\Admin\Forum;

use Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\BalasanForum;
use App\Models\Admin\Forum;

class BalasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $data = BalasanForum::join('users', 'users.id', 'balasan_forums.user_id')->join('forums', 'forums.id', 'balasan_forums.forum_id')->where('balasan_forums.sekolah_id', auth()->user()->id_sekolah)->orderBy("balasan_forums.id","desc")->get();
        // dd($data);   
        if ($request->ajax()) {
            $data = BalasanForum::join('users', 'users.id', 'balasan_forums.user_id')
                                ->join('forums', 'forums.id', 'balasan_forums.forum_id')
                                ->where('balasan_forums.sekolah_id', auth()->user()->id_sekolah)
                                ->orderBy("balasan_forums.id","desc")
                                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('user_id', function($data){
                    $data = $data['name'];
                    return $data;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.forum.balasan',['mySekolah' => User::sekolah(), 'addons' => $addons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        //
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}