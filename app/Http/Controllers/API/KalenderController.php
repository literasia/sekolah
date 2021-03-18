<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Models\Admin\Kalender;
use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Utils\ApiResponse;
use DateTime;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function index($id, Request $request)
    {
        $event = [];
        $pelajaran = [];
        $d    = new DateTime($request->tanggal);
        $day = $d->format('l');
        if ($day == "Sunday") {
            $day = "Minggu";
        } else if ($day == "Monday") {
            $day = "senin";
        } else if ($day == "Tuesday") {
            $day = "selasa";
        } else if ($day == "Wednesday") {
            $day = "rabu";
        } else if ($day == "Thursday") {
            $day = "kamis";
        } else if ($day == "Friday") {
            $day = "jumat";
        } else if ($day == "Saturday") {
            $day = "sabtu";
        }

        $data = JadwalPelajaran::join('mata_pelajarans', 'jadwal_pelajarans.mata_pelajaran_id', 'mata_pelajarans.id')->join('jam_pelajarans', 'jadwal_pelajarans.jam_pelajaran', 'jam_pelajarans.jam_ke')->where('tahun_ajaran', $request->tahun_ajaran)
            ->where('kelas_id', $request->kelas_id)
            ->where('semester', $request->semester)
            ->where('mata_pelajarans.sekolah_id', $id)
            ->where('jadwal_pelajarans.hari', 'kamis')
            ->orderBy('jam_pelajaran')
            ->get();

        $data = $data->groupBy('hari');

        $kalender = Kalender::where('sekolah_id', "=", $id)->where('start_date', '=', $request->tanggal)->get();

        // $event = [];
        // $kalender = [];

        if ($kalender->count() <= 0) {
            $event = [];
            $message = 'Data not found !';
        } else {
            foreach ($kalender as $kal) {
                $event[] = [
                    'id' => $kal->id ?? null,
                    'title' => $kal->title ?? null,
                    'tanggal_mulai' => $kal->start_date ?? null,
                    'tanggal_selesai' => $kal->end_date ?? null,
                    'jam_mulai' => $kal->start_clock ?? null,
                    'jam_selesai' => $kal->end_clock ?? null,
                ];
            }
        }

        if ($data->count() <= 0) {
            $pelajaran = [];
            $message = 'Data not found !';
        } else {
            foreach ($data[$day] as $d) {
                $pelajaran[] = [
                    // 'id' => $d->id ?? null,
                    'jam_pelajaran' => $d->jam_pelajaran ?? null,
                    'nama_pelajaran' => $d->nama_pelajaran ?? null,
                    'jam_mulai' => $d->jam_mulai ?? null,
                    'jam_selesai' => $d->jam_selesai ?? null,
                    'kode_pelajaran' => $d->kode_pelajaran ?? null,
                ];
            }
            $message = 'Success get Data';
        }


        return response()->json(ApiResponse::success([
            'Kalender' => [$event, $pelajaran],

            // 'Pelajaran' => $data[$day] ?? [],
        ], $message));
    }
}
