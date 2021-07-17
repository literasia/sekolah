<?php

namespace App\Http\Controllers\Superadmin\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\{KabupatenKota, Sekolah};
use Illuminate\Http\Request;
use PDF;

class TagihanController extends Controller
{
    public function index(Request $request) { 
        return view('superadmin.keuangan.tagihan');
    }

    public function print() {
     
        $pdf = PDF::loadview('superadmin.keuangan.laporan-tagihan');
        return $pdf->stream();
    }
}
