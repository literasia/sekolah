<?php

namespace App\Http\Controllers\Admin\PesertaDidik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TidakNaikKelasController extends Controller
{
    public function index() {
        return view('admin.pesertadidik.tidak-naik-kelas');
    }
}
