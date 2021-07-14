<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User, Role};
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Kelas;
use App\Models\Admin\PenggunaForum;
use App\Models\Admin\RoleForum;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $role_forum = RoleForum::orderBy('id','asc')->get();

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


        return view("admin.forum.pengguna")
                            ->with('addons', $addons)
                            ->with('role_forum', $role_forum)
                            ->with('mySekolah', User::sekolah());
    }

    public function edit($id){
        $pengguna_forum = PenggunaForum::findOrFail($id);

        return response()
            ->json([                
                'id'   => $pengguna_forum->id,
                'user_id' => $pengguna_forum->user->id,
                'role_forum_id' => $pengguna_forum->roleForum->pluck('id')->first(),
            ]);
    }

    public function update(Request $request){
        $data = $request->all();
        
        $rules = [
            'role_id' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        // $id = $request->hidden_id;
        $pengguna_forum = PenggunaForum::findOrFail($request->hidden_id);

        // $role = RoleForum::where('id', $data['role_id'])->first();
        $role_forum = RoleForum::findOrFail($request->role_id);

        // detach from pivot
        if ($pengguna_forum != null) {
            $pengguna_forum->roleForum()->detach();   
        }

        // foreach($pengguna_forum->roleForum as $role){
        //     $pengguna_forum->roleForum()->detach($role->id);
        // }
        
        // attach to pivot
        $pengguna_forum->roleForum()->attach($role_forum->id);

        // return response()->json(['success' => 'Data berhasil diubah.']);
        return response()->json(['success' => true, 'message' => 'Data berhasil diubah.']);
    }

    public function destroy($id) {
        $pengguna_forum = PenggunaForum::findOrFail($id);
    
        // detach from pivot
        $pengguna_forum->roleForum()->detach();   
        $pengguna_forum->delete();

        // return response()->json(['success' => 'Data berhasil dihapus.']);
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);   
    }

}
