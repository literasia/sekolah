<?php

namespace App\Http\Controllers\Guru\PesertaDidik;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class TidakNaikKelasController extends Controller
{
    public function index() {
        return view('guru.pesertadidik.tidak-naik-kelas', ['mySekolah' => User::sekolah()]);
    }
}
