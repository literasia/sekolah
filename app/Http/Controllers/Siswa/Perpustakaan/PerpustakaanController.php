<?php

namespace App\Http\Controllers\Siswa\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Pinjam;

class PerpustakaanController extends Controller
{ 
    public function index()
    {
        $data = Pinjam::select('pinjams.*', 'users.name AS nama_lengkap', 'libraries.name')
            ->join('users', 'users.siswa_id', 'pinjams.user_id')
            ->join('libraries', 'libraries.id', 'pinjams.library_id')
            ->where('users.id_sekolah', auth()->user()->id_sekolah)
            ->get();


        return view('siswa.perpustakaan.perpustakaan', [
            'mySekolah' => User::sekolah(),
            'data' => $data
        ]);
    }
}
