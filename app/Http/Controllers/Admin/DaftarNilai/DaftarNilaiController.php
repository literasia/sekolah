<?php

namespace App\Http\Controllers\Admin\DaftarNilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarNilaiController extends Controller
{
    public function index() {
        return view('admin.daftar-nilai');
    }
}
