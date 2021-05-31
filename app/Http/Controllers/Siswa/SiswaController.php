<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SiswaController extends Controller
{
    public function index() {
        return view('siswa.index');
    }

    public function update(Request $request)
    {
        return response()->json(["test"]);
    }
}
