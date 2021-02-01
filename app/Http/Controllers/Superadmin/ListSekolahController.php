<?php

namespace App\Http\Controllers\Superadmin;

use App\Role;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Superadmin\Sekolah;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

    public function store(Request $request) {
         // validasi
         $rules = [
            'id_sekolah'    => 'required|max:100',
            'name'          => 'required|max:100',
            'alamat'        => 'required',
            'jenjang'       => 'required',
            'tahun_ajaran'  => 'required',
            'username'      => 'required|max:100',
            'password'      => 'required',
        ];

        $message = [
            'id_sekolah.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $sekolah = Sekolah::create([
            'id_sekolah'    => $request->input('id_sekolah'),
            'name'          => $request->input('name'),
            'alamat'        => $request->input('alamat'),
            'jenjang'       => $request->input('jenjang'),
            'tahun_ajaran'  => $request->input('tahun_ajaran'),
        ]);
        $sekolah_id = DB::getPdo()->lastInsertId();
        $adminRole = Role::where('name', 'admin')->first();

        $user = User::create([
            'id_sekolah'    => $sekolah_id,
            'name'          => $request->input('name'),
            'username'      => $request->input('username'),
            'password'      => Hash::make($request->input('password')),
        ]);

        $user->roles()->attach($adminRole);

        return response()
            ->json([
                'success' => '👍 '.$request->input('name').' berhasil ditambahkan!',
            ]);
    }

    public function edit($id) {
        $sekolah    = Sekolah::find($id);

        return response()
            ->json([
                'sekolah'   => $sekolah,
                'user'      => User::where('id_sekolah', $sekolah->id)->get(),
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
           'id_sekolah'    => 'required|max:100',
           'name'          => 'required|max:100',
           'alamat'        => 'required',
           'jenjang'       => 'required',
           'tahun_ajaran'  => 'required',
       ];

       $message = [
           'id_sekolah.required' => 'Kolom ini gaboleh kosong',
       ];

       $validator = Validator::make($request->all(), $rules, $message);

       if ($validator->fails()) {
           return response()
               ->json([
                   'errors' => $validator->errors()->all()
               ]);
       }

       Sekolah::whereId($request->input('hidden_id'))->update([
           'id_sekolah'    => $request->input('id_sekolah'),
           'name'          => $request->input('name'),
           'alamat'        => $request->input('alamat'),
           'jenjang'       => $request->input('jenjang'),
           'tahun_ajaran'  => $request->input('tahun_ajaran'),
       ]);

       return response()
           ->json([
               'success' => '👍 '.$request->input('name').' berhasil diupdate!',
           ]);
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
        //  Return response
        // return response()
        //     ->json([
        //         'success' => $success,
        //         'message' => $message,
        //     ]);
        return response()
            ->json([
                'success' => '👍 '.$sekolah->name.' berhasil dihapus!',
            ]);
    }
}
