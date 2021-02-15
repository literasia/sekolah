<?php

namespace App\Http\Controllers\Admin\Absensi;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index() {
        return view('admin.absensi.siswa', ['mySekolah' => User::sekolah()]);
    }
}
