<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\{Kelas, Materi};
use App\User;
use App\Models\{MataPelajaran, JadwalPelajaran, Siswa};

class MateriController extends Controller
{
    public function getMapel(User $user){
        // init time zone
        date_default_timezone_set("Asia/Bangkok");
        
        // get siswa
        $siswa = Siswa::findOrFail($user->siswa_id);
        // get kelas siswa
        $kelas = Kelas::findOrFail($siswa->kelas_id);

        // check jadwal pelajaran this day
        // get day this day
        $day = date('l'); // ex : Monday
        $jadwal_pelajaran = new JadwalPelajaran;
        $getHari = $jadwal_pelajaran->getHari($day); // transform eng day to indo

        // ambil mata pelajaran yang id nya ada di jadwal pelajaran pada hari ini dan kelas yang dimiliki siswa saat nii
        $mata_pelajaran = MataPelajaran::whereIn('id', function($query) use($getHari, $kelas){
                            $query->select('mata_pelajaran_id')->from('jadwal_pelajarans')
                                                                        ->where('hari', $getHari)
                                                                        ->where('kelas_id', $kelas->id);
                          })->get();
        
        return response()->json(ApiResponse::success(['mata_pelajaran' => $mata_pelajaran]));
    }


    public function getMateri(User $user, MataPelajaran $mata_pelajaran){
        // get siswa
        $siswa = Siswa::findOrFail($user->siswa_id);
        // get kelas siswa
        $kelas = Kelas::findOrFail($siswa->kelas_id);

        // ambil data materi yang kelasnya dimiliki siswa
        $materi = Materi::where('kelas_id', $kelas->id)->where('mata_pelajaran_id', $mata_pelajaran->id)->get();
        
        return response()->json(ApiResponse::success(['materi' => $materi]));
    }

    public function getDetailMateri(Materi $materi){
        $materi = Materi::findOrFail($materi->id);
        
        return response()->json(ApiResponse::success(['materi' => $materi]));
        
    }
}
