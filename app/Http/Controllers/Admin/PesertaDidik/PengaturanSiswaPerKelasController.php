<?php

namespace App\Http\Controllers\Admin\PesertaDidik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanSiswaPerKelasController extends Controller
{
    public function index() {
        return view('admin.pesertadidik.pengaturan-siswa');
    }
}
