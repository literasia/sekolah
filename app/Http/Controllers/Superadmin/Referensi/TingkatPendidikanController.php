<?php

namespace App\Http\Controllers\Superadmin\Referensi;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Superadmin\TingkatPendidikan;
use App\Utils\CRUDResponse;

class TingkatPendidikanController extends Controller
{
    public function index(Request $request) { 
        if ($request->ajax()) {
            $data = TingkatPendidikan::latest()->get();
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
            'kelas'  => 'required',
        ];

        $message = [
            'tingkat.required' => 'Kolom ini gaboleh kosong',
            'kelas.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $tingkat = TingkatPendidikan::create([
            'tingkat'  => $request->input('tingkat'),
            'kelas'  => $request->input('kelas'),
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
            ]);
    }

    public function edit($id) {
        $tingkat = TingkatPendidikan::find($id);

        return response()
            ->json([
                'tingkat' => $tingkat,
                'kelas' => $tingkat->kelas
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
           'tingkat'  => 'required',
           'kelas'  => 'required',
       ];

       $message = [
           'tingkat.required' => 'Kolom ini gaboleh kosong',
           'kelas.required' => 'Kolom ini gaboleh kosong',
       ];

       $validator = Validator::make($request->all(), $rules, $message);

       if ($validator->fails()) {
           return response()
               ->json([
                   'errors' => $validator->errors()->all()
               ]);
       }

       TingkatPendidikan::whereId($request->input('hidden_id'))->update([
           'tingkat'  => $request->input('tingkat'),
           'kelas'  => $request->input('kelas'),
       ]);

       return response()
           ->json([
               'success' => 'Data berhasil diupdate.',
           ]);
    }

    public function destroy($id) {
        $tingkat = TingkatPendidikan::findOrFail($id);
        $tingkat->delete();

        return back()->with(CRUDResponse::successDeleteNotif("tingkat " . $tingkat->tingkat));
    }
}
