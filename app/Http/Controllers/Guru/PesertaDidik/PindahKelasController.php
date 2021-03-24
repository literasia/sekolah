<?php

namespace App\Http\Controllers\Guru\PesertaDidik;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PindahKelasController extends Controller
{
    public function index() {
        return view('guru.pesertadidik.pindah-kelas', ['mySekolah' => User::sekolah()]);
    }
}
