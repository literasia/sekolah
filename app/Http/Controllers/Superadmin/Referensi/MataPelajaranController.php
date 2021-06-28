<?php

namespace App\Http\Controllers\Superadmin\Referensi;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Guru;
use App\Models\Superadmin\ReferensiMataPelajaran;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class MataPelajaranController extends Controller
{
    public function index(Request $request) { 
        if ($request->ajax()) {
            $data = ReferensiMataPelajaran::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" data-id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('superadmin.referensi.matapelajaran');
    }

    public function store(Request $request) {
        $rules = [
            'nama_pelajaran'  => 'required',
        ];

        $message = [
            'nama_pelajaran.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $mapel = ReferensiMataPelajaran::create([
            'nama_pelajaran'  => $request->input('nama_pelajaran'),
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
            ]);
    }

    public function edit($id) {
        $mapel = ReferensiMataPelajaran::find($id);

        return response()
            ->json([
                'id' => $mapel->id,
                'nama_pelajaran' => $mapel->nama_pelajaran
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
           'nama_pelajaran'  => 'required',
       ];

       $message = [
           'nama_pelajaran.required' => 'Kolom ini gaboleh kosong',
       ];

       $validator = Validator::make($request->all(), $rules, $message);

       if ($validator->fails()) {
           return response()
               ->json([
                   'errors' => $validator->errors()->all()
               ]);
       }

       ReferensiMataPelajaran::whereId($request->input('hidden_id'))->update([
           'nama_pelajaran'  => $request->input('nama_pelajaran'),
       ]);

       return response()
           ->json([
               'success' => 'Data berhasil diupdate.',
           ]);
    }

    public function destroy($id) {
        $mapel = ReferensiMataPelajaran::find($id);
        $mapel->delete();
    }
}
