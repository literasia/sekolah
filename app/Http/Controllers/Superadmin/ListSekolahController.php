<?php

namespace App\Http\Controllers\Superadmin;

use App\Role;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Superadmin\Sekolah;
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
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
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

        $adminRole = Role::where('name', 'admin')->first();

        $user = User::create([
            'name'      => $request->input('name'),
            'username'  => $request->input('username'),
            'password'  => Hash::make($request->input('password')),
        ]);

        $user->roles()->attach($adminRole);

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
            ]);
    }
}
