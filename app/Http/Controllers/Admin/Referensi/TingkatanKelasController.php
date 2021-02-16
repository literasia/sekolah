<?php

namespace App\Http\Controllers\Admin\Referensi;

use Validator;
use Illuminate\Http\Request;
use App\Models\TingkatanKelas;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TingkatanKelasController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = TingkatanKelas::latest()->get();
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
        
        return view('admin.referensi.tingkatan-kelas');
    }

    public function store(Request $request) {
        // validasi
        $rules = [
            'tingkat'  => 'required|max:50',
        ];

        $message = [
            'tingkat.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = TingkatanKelas::create([
            'name'  => $request->input('tingkat'),
        ]);

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $tingkat = TingkatanKelas::find($id);

        return response()
            ->json([
                'tingkat'  => $tingkat
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'tingkat'  => 'required|max:50',
        ];

        $message = [
            'tingkat.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = TingkatanKelas::whereId($request->input('hidden_id'))->update([
            'name'  => $request->input('tingkat'),
        ]);

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $tingkat = TingkatanKelas::find($id);
        $tingkat->delete();
    }
}
