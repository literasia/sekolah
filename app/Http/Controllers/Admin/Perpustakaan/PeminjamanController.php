<?php

namespace App\Http\Controllers\Admin\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Pinjam;
use App\Models\Superadmin\Addons;

class PeminjamanController extends Controller
{ //
    public function index()
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        $data = Pinjam::select('pinjams.*', 'users.name AS nama_lengkap', 'libraries.name')
            ->join('users', 'users.siswa_id', 'pinjams.user_id')
            ->join('libraries', 'libraries.id', 'pinjams.library_id')
            ->where('users.id_sekolah', auth()->user()->id_sekolah)
            ->get();


        return view('admin.perpustakaan.peminjaman', [
            'mySekolah' => User::sekolah(),
            'data' => $data,
            'addons' => $addons,
        ]);
    }
}
