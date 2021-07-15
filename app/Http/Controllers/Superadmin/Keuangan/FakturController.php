<?php

namespace App\Http\Controllers\Superadmin\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\{KabupatenKota, Sekolah};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use PDF;

class FakturController extends Controller
{
    public function index(Request $request) { 
        return view('superadmin.keuangan.faktur');
    }

    public function print() {
     
        $pdf = PDF::loadview('superadmin.keuangan.laporan-faktur');
        return $pdf->stream();
    }
}