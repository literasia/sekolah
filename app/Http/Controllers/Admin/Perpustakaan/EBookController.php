<?php

namespace App\Http\Controllers\Admin\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class EBookController extends Controller
{
    public function index() {
        return view('admin.perpustakaan.e-book', ['mySekolah' => User::sekolah()]);
    }
}
