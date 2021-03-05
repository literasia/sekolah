<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\KabupatenKota;
use App\Models\Superadmin\Sekolah;
use App\Models\Superadmin\Library;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\SiswaOrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperadminController extends Controller
{
    public function index() {
        $audiobook = Library::whereNotNull('link_audio')->count();
        $videobook = Library::whereNotNull('link_video')->count();
        $ebook = Library::whereNotNull('link_ebook')->count();
        $kabupaten = KabupatenKota::count();
        $sekolah = Sekolah::count();
        $siswa = Siswa::count();
        $guru = Guru::count();
        $orangtua = SiswaOrangTua::count();

        $siswasByTahun = Siswa::groupBy('tahun')->get(DB::raw("YEAR(tanggal_masuk) AS tahun, COUNT(*) AS total"));

        return view('superadmin.index', [
            'audiobook' => $audiobook,
            'videobook' => $videobook,
            'ebook' => $ebook,
            'kabupaten' => $kabupaten,
            'sekolah' => $sekolah,
            'siswa' => $siswa,
            'guru' => $guru,
            'orangtua' => $orangtua,
            'siswasByTahun' => $siswasByTahun
        ]);
    }
}
