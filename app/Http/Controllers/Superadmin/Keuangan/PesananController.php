<?php

namespace App\Http\Controllers\Superadmin\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\{KabupatenKota, Sekolah};
use Illuminate\Http\Request;
use PDF;

class PesananController extends Controller
{
    public function index(Request $request) { 
        return view('superadmin.keuangan.pesanan');
    }

    public function print() {
     
        $pdf = PDF::loadview('superadmin.keuangan.laporan-pesanan');
        return $pdf->stream();
    }
}
