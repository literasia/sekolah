<?php

namespace App\Http\Controllers\Admin\Referensi;

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
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
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
            'name'  => 'required|max:100',
        ];
    }
}
