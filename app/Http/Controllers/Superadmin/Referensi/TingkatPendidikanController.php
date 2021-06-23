<?php

namespace App\Http\Controllers\Superadmin\Referensi;

use Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TingkatPendidikanController extends Controller
{
    public function index(Request $request) { 
        return view('superadmin.referensi.tingkatpendidikan');
    }
}
