<?php

namespace App\Http\Controllers\Admin\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AudioBookController extends Controller
{
    public function index() {
        return view('admin.perpustakaan.audio-book', ['mySekolah' => User::sekolah()]);
    }
}
