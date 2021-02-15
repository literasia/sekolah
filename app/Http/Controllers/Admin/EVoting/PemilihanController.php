<?php

namespace App\Http\Controllers\Admin\EVoting;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Pemilihan;
use App\Models\Admin\CalonKandidat;
use App\Models\Admin\Posisi;

class PemilihanController extends Controller
{
    public function index(Request $request) {
    	if ($request->ajax()) {
            $data = Pemilihan::latest()->get();
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
        $ck = CalonKandidat::all();
        $ps = Posisi::all();
        return view('admin.e-voting.pemilihan', ['ck' => $ck, 'ps' => $ps]);
    }

    public function store(Request $request) {
        // validasi
        $rules = [
            'nama_calon'  => 'required|max:50',
        ];

        $message = [
            'nama_calon.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }
        foreach ($request->input('nama_calon') as $nama_calon) {
            $status = Pemilihan::create([
            'name'          => $nama_calon,
            'posisi'        => $request->input('posisi'),
            'start_date'    => $request->input('tanggal_mulai'),
            'end_date'      => $request->input('tanggal_selesai')
        ]);
        }
        

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $name 	= Pemilihan::find($id);
        $posisi 		= Pemilihan::find($id);
        $start_date 	= Pemilihan::find($id);
        $end_date 		= Pemilihan::find($id);

        return response()
            ->json([
                'name' 			=> $name,
                'posisi'  		=> $posisi,
                'start_date'  	=> $start_date,
                'end_date'  	=> $end_date,
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'nama_calon'  => 'required|max:50',
        ];

        $message = [
            'nama_calon.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = Pemilihan::whereId($request->input('hidden_id'))->update([
            'name'  		=> $request->input('nama_calon'),
            'posisi'  		=> $request->input('posisi'),
            'start_date'  	=> $request->input('tanggal_mulai'),
            'end_date'  	=> $request->input('tanggal_selesai'),
        ]);

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $sanksi = Pemilihan::find($id);
        $sanksi->delete();
    }

}
