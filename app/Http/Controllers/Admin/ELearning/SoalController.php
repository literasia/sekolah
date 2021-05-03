<?php

namespace App\Http\Controllers\Admin\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Admin\Kelas;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SoalController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.e-learning.soal', ['mySekolah' => User::sekolah()]);  
    }
}
