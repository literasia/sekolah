<?php

namespace App\Http\Controllers\Admin\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Pinjam;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Pinjam::select('pinjams.*', 'siswas.nama_lengkap', 'libraries.name')->where('users.id_sekolah', 1)
            ->join('siswas', 'siswas.id', 'pinjams.siswa_id')
            ->join('libraries', 'libraries.id', 'pinjams.library_id')
            ->join('kelas', 'kelas.id', 'siswas.kelas_id')
            ->join('users', 'users.id', 'kelas.user_id')
            ->get();

        return view('admin.perpustakaan.peminjaman', [
            'mySekolah' => User::sekolah(),
            'data' => $data
        ]);
    }
}
