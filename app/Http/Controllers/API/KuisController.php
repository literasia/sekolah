<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Kuis, Soal, ButirSoal, PengaturanKuis};
use App\Models\{Guru, Siswa};
use App\Utils\ApiResponse;

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
}
