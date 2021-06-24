<?php

namespace App\Http\Controllers\Superadmin\Referensi;

use Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class MataPelajaranController extends Controller
{
    public function index(Request $request) { 
        return view('superadmin.referensi.matapelajaran');
    }
}
