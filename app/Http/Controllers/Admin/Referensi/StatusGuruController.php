<?php

namespace App\Http\Controllers\Admin\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusGuruController extends Controller
{
    public function index() {
        return view('admin.referensi.status-guru');
    }
}
