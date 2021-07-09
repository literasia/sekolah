<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Superadmin\KabupatenKota;
use App\Models\Superadmin\Sekolah;
use App\Models\Superadmin\Library;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\SiswaOrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Superadmin\Addons;

class AdminController extends Controller
{
    public function index() {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        
    	$audiobook = Library::whereNotNull('link_audio')->count();
        $videobook = Library::whereNotNull('link_video')->count();
        $ebook = Library::whereNotNull('link_ebook')->count();
        $kabupaten = KabupatenKota::count();
        $sekolah = Sekolah::where('id_sekolah')->count();
        // $siswa = User::where('role_id', 3)->where('id_sekolah', auth()->user()->id_sekolah)->count();
        // $guru = User::where('role_id', 4)->where('id_sekolah', auth()->user()->id_sekolah)->count();
        // $orangtua = User::where('role_id', 3)->where('id_sekolah', auth()->user()->id_sekolah)->count();
        
        $siswa = Siswa::whereIn('id', function($query){
            $query->select('siswa_id')->from('users')->where('id_sekolah', auth()->user()->id_sekolah);
        })->count();
        
        $guru = Guru::whereHas('user', function($query){
            $query->where('role_id', 4)->where('id_sekolah', auth()->user()->id_sekolah);
        })->count();
        
        $orangtua = Siswa::whereIn('id', function($query){
            $query->select('id_siswa')->from('siswa_orang_tuas');
        })->whereIn('id', function($query){
            $query->select('siswa_id')->from('users')->where('id_sekolah', auth()->user()->id_sekolah);
        })->count();
        
        return view('admin.index', [
        	'audiobook' => $audiobook,
            'videobook' => $videobook,
            'ebook' => $ebook,
            'kabupaten' => $kabupaten,
            'sekolah' => $sekolah,
            'siswa' => $siswa,
            'guru' => $guru,
            'orangtua' => $orangtua,
        	'mySekolah' => User::sekolah(),
            'addons' => $addons
        ]);
    }
}
