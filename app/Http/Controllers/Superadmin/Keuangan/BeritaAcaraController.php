<?php

namespace App\Http\Controllers\Superadmin\Keuangan

use App\Http\Controllers\Controller;
use App\Models\Superadmin\{Kabupaten, Sekolah};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use PDF;

class BeritaAcaraController extends Controller
{ 
    public function index(Request $request) { 
        return view('superadmin.keuangan.berita-acara');
    }

    public function print() {
     
        $pdf = PDF::loadview('superadmin.keuangan.laporan-berita-acara');
        return $pdf->stream();
    }
}
