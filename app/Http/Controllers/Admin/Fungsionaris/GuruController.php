<?php

namespace App\Http\Controllers\Admin\Fungsionaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\{User, Role};
use App\Models\{StatusGuru, Pegawai, Guru};
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    //readd
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        if ($request->ajax()) {
            $data = Guru::whereHas('user', function($query){
                $query->where('id_sekolah', auth()->user()->id_sekolah);
            })->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" data-id="' . $data->id . '" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })->addColumn('nama_pegawai', function($data){
                    return $data->pegawai->name;
                })->addColumn('nama_status', function($data){
                    return $data->statusGuru->name;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        // $pegawai = Pegawai::where('user_id', Auth::id())->latest()->get();
        // $user = User::sekolah();
        $pegawai = Pegawai::join('users', 'pegawais.user_id', 'users.id')
            ->where('users.id_sekolah', auth()->user()->id_sekolah)
            ->get(['pegawais.*']);
        $status = StatusGuru::where('user_id', Auth::id())->latest()->get();
        // return($pegawai);

        return view('admin.fungsionaris.guru',['pegawai' => $pegawai, 'status' => $status, 'addons' => $addons ,'mySekolah' => User::sekolah()]);
    }

    public function store(Request $request) {
        // Validation rules
        $rules = [
            'pegawai_id' => 'required',
            'status_guru_id' => 'required',
            'status' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        // Get user id pegawai
        $pegawai = Pegawai::findOrFail($request->pegawai_id);
        $user_id = User::findOrFail($pegawai->user_id);

        $request['user_id'] = $user_id->id;

        // get Roles to attach user roles
        $role = Role::where('name', 'guru')->first();

        // attach
        $user_id->roles()->attach($role->id);

        // Create Guru
        $guru = Guru::create($request->all());

        // Respons Data
        return response()->json(['success' => 'Data berhasil disimpan.']);
    }

    public function edit($id) {
        $guru = Guru::findOrFail($id);
        return response()->json([
            'id' => $guru->id,
            'user_id' => $guru->user_id,
            'pegawai_id' => $guru->pegawai_id,
            'status_guru_id' => $guru->status_guru_id,
            'keterangan' => $guru->keterangan,
            'status' => $guru->status,
        ]);
    }

    public function update(Request $request) {
        // Validation rules
        $rules = [
            'pegawai_id' => 'required',
            'status_guru_id' => 'required',
            'status' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        // get Guru
        $guru = Guru::findOrFail($request->hidden_id);  

        // update guru
        $guru->update($request->all());

        // Respons Data
        return response()->json(['success' => 'Data berhasil diubah.']);
    }

    public function destroy($id) {
        // get guru
        $guru = Guru::findOrFail($id);
        // delete guru
        $guru->delete();

        // Respons Data
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
