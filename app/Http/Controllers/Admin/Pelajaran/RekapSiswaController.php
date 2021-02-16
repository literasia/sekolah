<?php

namespace App\Http\Controllers\Admin\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapSiswaController extends Controller
{

    public function index() {
        return view('admin.pelajaran.jadwal-pelajaran');
    }
}
