<?php

namespace App\Http\Controllers\Admin\ERapor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class KenaikanKelasController extends Controller
{
    public function index() {
        return view('admin.e-rapor.kenaikan-kelas', ['mySekolah' => User::sekolah()]);
    }
}
