<?php

namespace App\Http\Controllers\Guru\DaftarNilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DaftarNilaiController extends Controller
{
    public function index() {
        return view('guru.daftar-nilai', ['mySekolah' => User::sekolah()]);
    }
}
