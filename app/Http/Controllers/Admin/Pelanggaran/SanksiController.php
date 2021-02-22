<?php

namespace App\Http\Controllers\Admin\Pelanggaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanksiController extends Controller
{
    public function index() {
        return view('admin.pelanggaran.sanksi');
    }
}
