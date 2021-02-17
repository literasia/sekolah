<?php

namespace App\Http\Controllers\Admin\Pelajaran;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\MataPelajaran;
use App\Models\StatusGuru;
use App\User;

class MataPelajaranController extends Controller
{

    public function index(Request $request) {
    	if ($request->ajax()) {
            $data = MataPelajaran::latest()->get();
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

        $status = StatusGuru::all();
        return view('admin.pelajaran.mata-pelajaran', ['status' => $status]);
    }
}
