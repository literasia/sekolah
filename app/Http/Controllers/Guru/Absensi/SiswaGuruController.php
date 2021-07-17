<?php

namespace App\Http\Controllers\Guru\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Kelas;
use App\Models\{Siswa, Absensi, Guru};
use App\User;

class SiswaGuruController extends Controller
{
    public function index(Request $request) {
        // get data guru
        $guru = Guru::where('user_id', auth()->user()->id)->first();

        $kelas = Kelas::where('pegawai_id', $guru->pegawai->id)->get();
        $data = [];

        $tanggal = $request->tanggal;
        $kelas_id = $request->kelas_id;

        if($request->req == 'table') {
            $data = Siswa::with(['kelas',
                                 'absensi' => function($q) use($request){
                                     $q->where('tanggal', $request->tanggal)->where('kelas_id', $request->kelas_id);
                                }])
                         ->where('kelas_id', $request->kelas_id)
                         ->orderBy('nama_lengkap')
                         ->get();
        }


        return view('guru.absensi.siswa')->with('kelas', $kelas)
                                         ->with('data', $data)
                                         ->with('kelas_id', $kelas_id)
                                         ->with('tanggal', $tanggal)
                                         ->with('mySekolah', User::sekolah());
    }

    public function approve(Request $request) {
        $absensi = Absensi::where('kelas_id', $request->kelas_id)
                            ->where('siswa_id', $request->siswa_id)
                            ->where('tanggal', date('Y-m-d', strtotime($request->tanggal)))
                            ->first();

        if ($absensi == null) {
            Absensi::create([
                'kelas_id' => $request->kelas_id,
                'tanggal' => $request->tanggal,
                'siswa_id' => $request->siswa_id,
                'status' => $request->status,
                'editor_id' => $request->user()->id
            ]);
        }else{
            $absensi->update([
                'kelas_id' => $request->kelas_id,
                'tanggal' => $request->tanggal,
                'siswa_id' => $request->siswa_id,
                'status' => $request->status,
                'editor_id' => $request->user()->id
            ]);
        }

        return redirect()->back();
    }

    public function approveAll(Request $request){
        $hadir = explode(';', $request->hadir_collect);
        $absen = explode(';', $request->absen_collect);
        $sakit = explode(';', $request->sakit_collect);
        $izin = explode(';', $request->izin_collect);
        $lainnya = explode(';', $request->lainnya_collect);

        if (count($hadir) > 0) {
            for ($i=0; $i < count($hadir); $i++) { 
                if ($hadir[$i] != "") {     
                    $absensi = Absensi::where('kelas_id', $request->kelas_id)
                                      ->where('siswa_id', $hadir[$i])
                                      ->where('tanggal', date('Y-m-d', strtotime($request->tanggal)))
                                      ->first();
    
                    if ($absensi == null) {
                        Absensi::create([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $hadir[$i],
                            'status' => "H",
                            'editor_id' => $request->user()->id
                        ]);   
                    }else{
                        $absensi->update([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $hadir[$i],
                            'status' => "H",
                            'editor_id' => $request->user()->id
                        ]);
                    }
                }
            }
        }

        if (count($absen) > 0) {
            for ($i=0; $i < count($absen); $i++) { 
                if ($absen[$i] != "") {
                    $absensi = Absensi::where('kelas_id', $request->kelas_id)
                                      ->where('siswa_id', $absen[$i])
                                      ->where('tanggal', date('Y-m-d', strtotime($request->tanggal)))
                                      ->first();
    
                    if ($absensi == null) {
                        Absensi::create([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $absen[$i],
                            'status' => "A",
                            'editor_id' => $request->user()->id
                        ]);   
                    }else{
                        $absensi->update([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $absen[$i],
                            'status' => "A",
                            'editor_id' => $request->user()->id
                        ]);
                    }
                }
            }
        }

        if (count($sakit) > 0) {
            for ($i=0; $i < count($sakit); $i++) { 
                if ($sakit[$i] != "") {
                    $absensi = Absensi::where('kelas_id', $request->kelas_id)
                                      ->where('siswa_id', $sakit[$i])
                                      ->where('tanggal', date('Y-m-d', strtotime($request->tanggal)))
                                      ->first();
    
                    if ($absensi == null) {
                        Absensi::create([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $sakit[$i],
                            'status' => "S",
                            'editor_id' => $request->user()->id
                        ]);   
                    }else{
                        $absensi->update([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $sakit[$i],
                            'status' => "S",
                            'editor_id' => $request->user()->id
                        ]);
                    }
                }
            }
        }

        if (count($izin) > 0) {
            for ($i=0; $i < count($izin); $i++) { 
                if ($izin[$i] != "") {
                    $absensi = Absensi::where('kelas_id', $request->kelas_id)
                                      ->where('siswa_id', $izin[$i])
                                      ->where('tanggal', date('Y-m-d', strtotime($request->tanggal)))
                                      ->first();
    
                    if ($absensi == null) {
                        Absensi::create([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $izin[$i],
                            'status' => "I",
                            'editor_id' => $request->user()->id
                        ]);   
                    }else{
                        $absensi->update([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $izin[$i],
                            'status' => "I",
                            'editor_id' => $request->user()->id
                        ]);
                    }
                }
            }
        }

        if (count($lainnya) > 0) {
            for ($i=0; $i < count($lainnya); $i++) { 
                if ($lainnya[$i] != "") {
                    $absensi = Absensi::where('kelas_id', $request->kelas_id)
                                      ->where('siswa_id', $lainnya[$i])
                                      ->where('tanggal', date('Y-m-d', strtotime($request->tanggal)))
                                      ->first();
    
                    if ($absensi == null) {
                        Absensi::create([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $lainnya[$i],
                            'status' => "L",
                            'editor_id' => $request->user()->id
                        ]);   
                    }else{
                        $absensi->update([
                            'kelas_id' => $request->kelas_id,
                            'tanggal' => $request->tanggal,
                            'siswa_id' => $lainnya[$i],
                            'status' => "L",
                            'editor_id' => $request->user()->id
                        ]);
                    }
                }
            }
        }

        return redirect()->back();
    }
}
