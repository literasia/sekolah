<?php

namespace App\Http\Controllers\Guru\PesertaDidik;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index() {
        return view('guru.pesertadidik.alumni', ['mySekolah' => User::sekolah()]);
    }
}
