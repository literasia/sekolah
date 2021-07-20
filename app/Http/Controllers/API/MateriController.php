<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;
use App\Models\Admin\{Kelas, Materi, Kuis};
use App\User;
use App\Models\{MataPelajaran, JadwalPelajaran, Siswa};

class MateriController extends Controller
{
    public function getMapel(User $user, $day){
        // init time zone
        date_default_timezone_set("Asia/Bangkok");
        
        // get siswa
        $siswa = Siswa::findOrFail($user->siswa_id);
        // get kelas siswa
        $kelas = Kelas::findOrFail($siswa->kelas_id);

        // check jadwal pelajaran this day
        // get day this day
        // $day = date('l'); // ex : Monday
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
        
        $elearning = [];

        // ambil data materi yang kelasnya dimiliki siswa
        $materi = Materi::where('kelas_id', $kelas->id)->where('mata_pelajaran_id', $mata_pelajaran->id)->get();

        // ambil data kuis yang kelasnya dimiliki siswa
        $kuis = Kuis::whereHas('soal', function($query) use($kelas, $mata_pelajaran){
            $query->where('kelas_id', $kelas->id)->where('mata_pelajaran_id', $mata_pelajaran->id);
        })->get();

        // push materi to elearning collections : type(materi)
        foreach ($materi as $item) {
            array_push($elearning, [
                'id' => $item->id,
                'type' => 'materi',
                'judul' => $item->judul,
                'isi' => $item->materi,
                'keterangan' => $item->keterangan,
                'created_at' => $item->created_at,
            ]);
        }

        // push kuis to elearning collection : type(kuis)
        foreach ($kuis as $item) {
            array_push($elearning, [
                'id' => $item->id,
                'type' => 'kuis',
                'judul' => $item->soal->judul,
                'isi' => '-',
                'keterangan' => $item->keterangan,
                'created_at' => $item->created_at,
            ]);
        }
          
        // Sort the array 
        usort($elearning, function($element1, $element2){
            $datetime1 = strtotime($element1['created_at']);
            $datetime2 = strtotime($element2['created_at']);
            return $datetime1 - $datetime2;
        });

        return response()->json(ApiResponse::success(['elearning' => $elearning]));
    }

    public function getDetailMateri(Materi $materi){
        $materi = Materi::findOrFail($materi->id);
        
        return response()->json(ApiResponse::success(['materi' => $materi]));
        
    }
}
