<?php

namespace App\Http\Controllers\Admin\Referensi;

use Validator;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class BagianPegawaiController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Pegawai::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.referensi.bagian-pegawai');
    }

    public function store(Request $request) {
        // validasi
        $rules = [
            'pegawai'  => 'required|max:100',
        ];

        $message = [
            'pegawai.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $pegawai = Pegawai::create([
            'name'  => $request->input('pegawai'),
        ]);

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $pegawai = Pegawai::find($id);

        return response()
            ->json([
                'pegawai'   => $pegawai
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'pegawai'  => 'required|max:100',
        ];

        $message = [
            'pegawai.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Pegawai::whereId($request->hidden_id)->update([
            'name'  => $request->input('pegawai'),
        ]);

        return response()
            ->json([
                'success'   => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
    }
}
