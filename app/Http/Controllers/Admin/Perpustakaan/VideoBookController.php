<?php

namespace App\Http\Controllers\Admin\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class VideoBookController extends Controller
{
    public function index() {
        return view('admin.perpustakaan.video-book', ['mySekolah' => User::sekolah()]);
    }
}
