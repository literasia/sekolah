<?php

namespace App\Http\Controllers\Admin\Fungsionaris;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index() {
        return view('admin.fungsionaris.guru', ['mySekolah' => User::sekolah()]);
    }
}
