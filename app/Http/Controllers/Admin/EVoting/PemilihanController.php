<?php

namespace App\Http\Controllers\Admin\EVoting;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PemilihanController extends Controller
{
    public function index() {
        return view('admin.e-voting.pemilihan', ['mySekolah' => User::sekolah()]);
    }
}
