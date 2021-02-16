<?php

namespace App\Http\Controllers\Admin\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapSiswaController extends Controller
{
    public function index() {
        return view('admin.absensi.rekap-siswa');
    }
}
