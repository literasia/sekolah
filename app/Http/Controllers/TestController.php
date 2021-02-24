<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class TestController extends Controller
{
    public function __invoke(Request $request) {
        
        $pegawai = Pegawai::with('user')->findOrFail(1);

        dump($pegawai->user);
    }
}
