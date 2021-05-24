<?php

namespace App\Http\Controllers\Admin\BankSoal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Admin\Kelas;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;

class SoalController extends Controller
{ //
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        return view('admin.banksoal.soal', ['mySekolah' => User::sekolah(), 'addons' => $addons]);  
    }
}
