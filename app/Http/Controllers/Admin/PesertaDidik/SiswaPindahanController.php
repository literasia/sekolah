<?php

namespace App\Http\Controllers\Admin\PesertaDidik;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\Superadmin\Addons;

class SiswaPindahanController extends Controller
{
    public function index() {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        return view('admin.pesertadidik.siswa-pindahan', ['mySekolah' => User::sekolah(), 'addons' => $addons]);
    }
}
