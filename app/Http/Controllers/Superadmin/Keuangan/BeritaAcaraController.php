<?php

namespace App\Http\Controllers\Superadmin\********;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\{********, ********};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use PDF;

class ******** extends Controller
{ //
    public function index(Request $request) { 
        return view('********.********.********-********');
    }

    public function print() {
     
        $pdf = PDF::loadview('********.********.********-********-********');
        return $pdf->stream();
    }
}
