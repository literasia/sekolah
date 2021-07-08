<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Kuis, Soal, LogKuis, ButirSoal, HasilKuis, PengaturanKuis, JawabanKuisSiswa};
use App\Models\{Guru, Siswa};
use App\Utils\ApiResponse;
use App\User;

class KuisController extends Controller
{
    public function getKuis(Kuis $kuis){
        // ambil soal yang telah dipilih
        $soal = Soal::findOrFail($kuis->soal_id);
        $pengaturan_kuis = PengaturanKuis::findOrFail($kuis->pengaturan_kuis_id);

        $butir_soal = [];
        
        $butir_soal_pg = null;
        $butir_soal_esai = null;

        // check kuis random
        if ($pengaturan_kuis->random_question == 1) {
            // ambil butir soal (RANDOM) -> dan ambil jumlah soal berdasarkan jumlah soal yang diuji {PG}
            $butir_soal_pg = ButirSoal::Where('soal_id', $soal->id)
                                    ->where('jenis_soal', 'multiple-choice')
                                    ->orderByRaw("RAND()")->limit($kuis->jumlah_soal_pg)->get();

            // ambil butir soal (RANDOM) -> dan ambil jumlah soal berdasarkan jumlah soal yang diuji {ES}                
            $butir_soal_esai = ButirSoal::Where('soal_id', $soal->id)
                                    ->where('jenis_soal', 'single-choice')
                                    ->orderByRaw("RAND()")->limit($kuis->jumlah_soal_essai)->get();
        }else{
            $butir_soal_pg = ButirSoal::Where('soal_id', $soal->id)
                                      ->where('jenis_soal', 'multiple-choice')
                                      ->get();

            $butir_soal_esai = ButirSoal::Where('soal_id', $soal->id)
                                      ->where('jenis_soal', 'single-choice')
                                      ->get();
        } 

        if($pengaturan_kuis->random_option){
            // Split multiple choice
            foreach ($butir_soal_pg as $item) {
                $opsi = explode("|literasia_sekolah|", $item->jawaban);
                // random index
                $numbers = range(0, count($opsi) - 1);
                // suffle index
                shuffle($numbers);
                // random opsi collection
                $ran_opsi = [];
                // push to random opsi
                foreach ($numbers as $number) {
                    array_push($ran_opsi, $opsi[$number]);
                }

                // push to items
                $items = [
                    "id" => $item->id,
                    "pertanyaan" => $item->pertanyaan,
                    "kunci_jawaban" => $item->kunci_jawaban,
                    "jawaban" => $ran_opsi
                ];

                // push to butir_soal
                array_push($butir_soal, $items);
            }
        }else{
            // Split multiple choice
            foreach ($butir_soal_pg as $item) {
                $opsi = explode("|literasia_sekolah|", $item->jawaban);
                
                // push to items
                $items = [
                    "id" => $item->id,
                    "pertanyaan" => $item->pertanyaan,
                    "kunci_jawaban" => $item->kunci_jawaban,
                    "jawaban" => $opsi
                ];

                // push to butir_soal
                array_push($butir_soal, $items);
            }
        }

        // insert essai to array
        foreach ($butir_soal_esai as $item) {
            // push to items
            $items = [
                "id" => $item->id,
                "pertanyaan" => $item->pertanyaan,
                "kunci_jawaban" => null,
                "jawaban" => null,
            ];

            // push to butir_soal
            array_push($butir_soal, $items);
        }
        
        return response()->json([
            'success' => true,
            'kuis' => $kuis,
            'pengaturan_kuis' => $pengaturan_kuis,
            'soal' => $soal,
            'butir_soal' => $butir_soal
        ]);        
    }

    public function updateJawaban(User $user, Kuis $kuis, Request $request){
        // get siswa
        $siswa = Siswa::findOrFail($user->siswa_id);

        // ambil data jawaban siswa dimana kuisnya yang sedang dikerjakan
        $jawaban_kuis = JawabanKuisSiswa::where('siswa_id', $siswa->id)
                                   ->where('kuis_id', $kuis->id)
                                   ->where('butir_soal_id', $request->butir_soal_id)->first();

        $data = [
            'siswa_id' => $siswa->id,
            'kuis_id' => $kuis->id,
            'butir_soal_id' => $request->butir_soal_id, 
            'jawaban' => $request->jawaban != "" ? null : strtoupper($request->jawaban),
        ];

        // check apakah jawaban siswa tersebut sudah ada di table?
        if ($jawaban_kuis == null) {
            // jika belum create
            JawabanKuisSiswa::create($data);
        }else{
            $jawaban_kuis->update($data);
        }

        return response()->json(ApiResponse::success(['siswa_id' => $siswa->id,
                                                      'kuis_id' => $kuis->id,
                                                      'butir_soal_id' => $request->butir_soal_id, 
                                                      'jawaban' => strtoupper($request->jawaban),
                                                    ]));
    }

    public function finishQuiz(Request $request){
        $kuis_id = $request->kuis_id;
        $siswa_id = $request->siswa_id;
        // data yang dikirim string, harus di decode menjadi json
        $jawaban = json_decode($request->jawaban);

        // get siswa
        $siswa = Siswa::findOrFail($siswa_id);

        // get kuis
        $kuis = Kuis::findOrFail($kuis_id);

        // ambil butir soal yang yang kuis id nya itu 
        $butir_soal = ButirSoal::where('soal_id', $kuis->soal_id)->get();


        // masukkan kedalam table jawaban_kuis_siswa
        foreach ($butir_soal as $key => $item) {
            $key = array_search($item->id, array_column($jawaban, 'butir_soal_id'));
            if (is_numeric($key)) {
                $jawaban_kuis_siswa = JawabanKuisSiswa::where('siswa_id', $siswa_id)
                                                      ->where('kuis_id', $kuis_id)
                                                      ->where('butir_soal_id', $item->id)
                                                      ->first();
                
                $jawaban_kuis_siswa_data = [
                    'siswa_id' => $siswa_id,
                    'kuis_id' => $kuis_id,
                    'butir_soal_id' => $item->id,
                    'jawaban' => $item->jenis_soal == "multiple-choice" ? strtoupper($jawaban[$key]->answer) : $jawaban[$key]->answer,
                ];

                // jika data jawaban kuis siswa tersebut sudah ada di table nya maka cukup update saja
                if ($jawaban_kuis_siswa == null) {
                    JawabanKuisSiswa::create($jawaban_kuis_siswa_data);
                }else{
                    $jawaban_kuis_siswa->update($jawaban_kuis_siswa_data);
                }                                         
            }
        }
        
        // check benar salah pada jawaban
        $jawaban_benar = 0;
        $jawaban_salah = 0;

        // ambil semua data jawaban kuis siswa dimana kuis yg sedang dikerjakan dan siswa yang mengerjakan
        // dan yang pg saja
        $jawaban_kuis_siswa = JawabanKuisSiswa::whereHas('butirSoal', function($query){
            $query->where('jenis_soal', 'multiple-choice');
        })->where('kuis_id', $kuis_id)->where('siswa_id', $siswa_id)->get();

        foreach ($jawaban_kuis_siswa as $item) {
            if ($item->jawaban == $item->butirSoal->kunci_jawaban) {
                $jawaban_benar += 1;            
            }else{
                $jawaban_salah += 1;
            }   
        }

        // hitung total nilai
        $total_nilai = ($jawaban_benar / count($jawaban_kuis_siswa)) * 100;
        
        // ambil hasil ujian yang kuis id nya itu dan siswa nya itu
        $hasil_kuis = HasilKuis::where('siswa_id', $siswa_id)->where('kuis_id', $kuis_id)->first();
    
        // jika udah ada update
        $hasil_kuis_data = [
            'kuis_id' => $kuis_id,
            'siswa_id' => $siswa_id,
            'jumlah_benar' => $jawaban_benar,
            'jumlah_salah' => $jawaban_salah,
            'nilai' => $total_nilai,
        ];

        // jika hasil kuis sudah ada maka hanya perlu update saja.
        if ($hasil_kuis == null) {
            HasilKuis::create($hasil_kuis_data);
        }else{
            $hasil_kuis->update($hasil_kuis_data);
        }

        // update log kuis
        $log_kuis = LogKuis::where('siswa_id', $siswa_id)->where('kuis_id', $kuis_id)->first();

        if ($log_kuis == null) {
            LogKuis::create([
                'siswa_id' => $siswa_id,
                'kuis_id' => $kuis_id,
                'status' => 1,
            ]);
        }

        // regenerate
        $hasil_kuis = HasilKuis::where('siswa_id', $siswa_id)->where('kuis_id', $kuis_id)->first();
        return response()->json(ApiResponse::success($hasil_kuis));
    }
}   
