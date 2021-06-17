<?php

namespace App\Http\Controllers\Admin\Absensi;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\TingkatanKelas;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Admin\Kelas;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class QRCodeController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        return view('admin.absensi.qr-code',['mySekolah' => User::sekolah(), 'addons' => $addons]);   
    }
}
