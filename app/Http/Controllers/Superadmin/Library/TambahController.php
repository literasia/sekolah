<?php

namespace App\Http\Controllers\Superadmin\Library;

use Illuminate\Http\Request;
use App\Models\Superadmin\Tipe;
use Yajra\DataTables\DataTables;
use App\Models\Superadmin\Library;
use App\Models\Superadmin\Sekolah;
use App\Http\Controllers\Controller;

class TambahController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Library::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" onclick="deleteConfirmation('.$data->id.')" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('superadmin.library.tambah-baru', [
            'sekolahs'  => Sekolah::latest()->get(),
            'tipes'     => Tipe::latest()->get(),
        ]);
    }
}
