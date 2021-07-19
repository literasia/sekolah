<?php

namespace App\Http\Controllers\Siswa\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index() {
        return view('siswa.absensi.absensi-siswa');
    }
}
