<?php

namespace App\Http\Controllers\Superadmin\Referensi;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Superadmin\Tingkat;
use App\Utils\CRUDResponse;

class TingkatPendidikanController extends Controller
{
    public function index(Request $request) { 
        if ($request->ajax()) {
            $data = Tingkat::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('superadmin.referensi.tingkatpendidikan');

    }

    public function store(Request $request) {
        $rules = [
            'tingkat'  => 'required',
            'name'  => 'required',
        ];

        $message = [
            'tingkat.required' => 'Kolom ini tidak boleh kosong',
            'name.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $tingkat = Tingkat::create([
            'tingkat'  => $request->input('tingkat'),
            'name'  => $request->input('name'),
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
            ]);
    }

    public function edit($id) {
        $tingkat = Tingkat::find($id);

        return response()
            ->json([
                'tingkat' => $tingkat,
                'name' => $tingkat->name
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
           'tingkat'  => 'required',
           'name'  => 'required',
       ];

       $message = [
           'tingkat.required' => 'Kolom ini tidak boleh kosong',
           'name.required' => 'Kolom ini tidak boleh kosong',
       ];

       $validator = Validator::make($request->all(), $rules, $message);

       if ($validator->fails()) {
           return response()
               ->json([
                   'errors' => $validator->errors()->all()
               ]);
       }

       Tingkat::whereId($request->input('hidden_id'))->update([
           'tingkat'  => $request->input('tingkat'),
           'name'  => $request->input('name'),
       ]);

       return response()
           ->json([
               'success' => 'Data berhasil diupdate.',
           ]);
    }

    public function destroy($id) {
        $tingkat = Tingkat::findOrFail($id);
        $tingkat->delete();

        return back()->with(CRUDResponse::successDeleteNotif("name " . $tingkat->name));
    }
}
