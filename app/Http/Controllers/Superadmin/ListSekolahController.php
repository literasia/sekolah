<?php

namespace App\Http\Controllers\Superadmin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Superadmin\Sekolah;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ListSekolahController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Sekolah::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    // $button .= '&nbsp;&nbsp;&nbsp;<button type="button" onclick="deleteConfirmation('.$data->id.')" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('superadmin.list-sekolah');
    }

    public function store(Request $req) {
        $data = $req->all();
        $rules = [
            'id_sekolah'    => 'required|max:100',
            'name'          => 'required|max:100',
            'alamat'        => 'required',
            'jenjang'       => 'required',
            'tahun_ajaran'  => 'required',
            'username'      => 'required|max:100|unique:users,username',
            'password'      => 'required',
        ];

        $message = [
            'id_sekolah.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        $sekolahId = Sekolah::create([
            'id_sekolah'    => $data['id_sekolah'],
            'name'          => $data['name'],
            'alamat'        => $data['alamat'],
            'jenjang'       => $data['jenjang'],
            'tahun_ajaran'  => $data['tahun_ajaran']
        ])->id;
        $adminRole = Role::where('name', 'admin')->first();

        User::create([
            'id_sekolah'    => $sekolahId,
            'role_id'       => $adminRole->id,
            'name'          => $data['name'],
            'username'      => $data['username'],
            'password'      => Hash::make($data['password'])
        ]);

        return back()->with(CRUDResponse::successCreate("sekolah " . $data['name']));
    }

    public function edit($id) {
        $sekolah = Sekolah::find($id);

        return response()
            ->json([
                'sekolah'   => $sekolah,
                'user'      => User::where('id_sekolah', $sekolah->id)->get(),
            ]);
    }

    public function update(Request $req) {
        $data = $req->all();
        $id = $data['hidden_id'];
        Sekolah::findOrFail($id);

        $rules = [
           'id_sekolah'    => 'max:100',
           'name'          => 'required|max:100',
           'alamat'        => 'required',
           'jenjang'       => 'required',
           'tahun_ajaran'  => 'required',
       ];

       $message = [
           'id_sekolah.required' => 'Kolom ini gaboleh kosong',
       ];

       $validator = Validator::make($data, $rules, $message);

       if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
       }

       Sekolah::whereId($id)->update([
           'id_sekolah'    => $data['id_sekolah'],
           'name'          => $data['name'],
           'alamat'        => $data['alamat'],
           'jenjang'       => $data['jenjang'],
           'tahun_ajaran'  => $data['tahun_ajaran']
       ]);

       return back()->with(CRUDResponse::successUpdate("sekolah " . $data['name']));
    }

    public function destroy($id) {
        $sekolah    = Sekolah::find($id);

        $role = DB::delete('delete from role_user where user_id = ?', [$id]);
        $user = User::where('id_sekolah', $id)->first()->delete();
        $data = Sekolah::where('id', $id)->first()->delete();
        // check data deleted or not
        if ($data == 1) {
            $success = true;
            $message = "Berhasil Dihapus";
        } else {
            $success = true;
            $message = "Data Tidak Ada";
        }
        
        return response()
            ->json([
                'success' => '👍 '.$sekolah->name.' berhasil dihapus!',
            ]);
    }
}
