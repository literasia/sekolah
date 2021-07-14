<?php

namespace App\Http\Controllers\Admin\Forum;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Models\Superadmin\Addons;
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
        $addons = Addons::where('user_id', auth()->user()->id)->first();

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

        return view('admin.forum.dashboard',  ['mySekolah' => User::sekolah(), 'addons' => $addons,'topiks' => $topiks, 'users' => $users]);
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
    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'judul' => 'required',
            'topik_id' => 'required|max:100',
            'total_balasan' => 'required|max:100',
            'user_id' => 'required|max:100',
            'privasi' => 'required|max:100',

        ];
        
        $validator = Validator::make($request->all(), $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        Forum::create([
            'judul' => $request->judul,
            'topik_id' => $request->topik_id,
            'total_balasan' => $request->total_balasan,
            'user_id' => $request->user_id,
            'privasi' => $request->privasi,
        ]);
    
        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $forum = Forum::findOrFail($id);

        return response()
            ->json([
                'id' => $forum->id,
                'judul'   => $forum->judul,
                'topik_id'   => $forum->topik_id,
                'total_balasan'   => $forum->total_balasan,
                'user_id'   => $forum->user_id,
                'privasi' => $forum->privasi            
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $data = $request->all();
        // dd($data);    
        $rules = [
            'judul' => 'required',
            'topik_id' => 'required',
            'total_balasan' => 'required',
            'user_id' => 'required',
            'privasi' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $forum = Forum::findOrFail($request->hidden_id);

        $forum->update([
            'judul' => $request->judul,
            'topik_id' => $request->topik_id,
            'total_balasan' => $request->total_balasan,
            'user_id' => $request->user_id,
            'privasi' => $request->privasi,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $forum = Forum::findOrFail($id);

        $forum->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
