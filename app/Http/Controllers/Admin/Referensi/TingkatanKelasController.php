<?php

namespace App\Http\Controllers\Admin\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TingkatanKelasController extends Controller
{
    public function index() {
        return view('admin.referensi.tingkatan-kelas');
    }
}
