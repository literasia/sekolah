<?php

namespace App\Http\Controllers\Admin\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Kuis, Soal, PengaturanKuis, ButirSoal};
use App\Models\Guru;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KuisController extends Controller
{
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $soal = Soal::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $guru = Guru::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();


        if ($request->ajax())
        {
            $kuis = Kuis::where('sekolah_id', auth()->user()->id_sekolah)->latest()->get();
            return DataTables::of($kuis)
                ->addColumn('action', function ($kuis) {
                    $button = '<button type="button" data-id="'.$kuis->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$kuis->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('paket_soal', function($kuis){
                    return $kuis->soal->judul;
                })
                ->addColumn('guru', function($kuis){
                    return $kuis->guru->pegawai->name;
                })
                ->addColumn('durasi', function($kuis){
                    return $kuis->durasi.' Menit';
                })
                ->editColumn('status', function($kuis){
                    if ($kuis->status == "Draf") {
                        return '<label class="badge badge-info m-0">Draf</label>';
                    }

                    if ($kuis->status == "Terbitkan") {
                        return '<label class="badge badge-success m-0">Terbit</label>';
                    }
                })
                ->editColumn('jenis_kuis', function($kuis){
                    if ($kuis->jenis_kuis == "ulangan") {
                        return '<p class="text-primary m-0">Ulangan</p>';
                    }

                    if ($kuis->jenis_kuis == "latihan") {
                        return '<p class="text-success m-0">Latihan</p>';
                    }
                })
                ->editColumn('jumlah_soal_pg', function($kuis){
                    $soal_pg = '<label class="badge badge-danger py-2 px-3">'.$kuis->jumlah_soal_pg.'</label';
                    return $soal_pg;
                })
                ->editColumn('jumlah_soal_essai', function($kuis){
                    $soal_essai = '<label class="badge badge-warning py-2 px-3">'.$kuis->jumlah_soal_essai.'</label';
                    return $soal_essai;
                })
                ->rawColumns(['action', 'status', 'jenis_kuis', 'jumlah_soal_essai', 'jumlah_soal_pg'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.e-learning.kuis')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('addons', $addons)
                                    ->with('guru', $guru)
                                    ->with('soal', $soal);
    }

    public function store(Request $request){
        $data = $request->all();
        // return response()->json($data);
        $rules = [
            'soal_id' => 'required',
            'guru_id' => 'required',
            'jenis_kuis' => 'required',
            'keterangan' => 'required',
            'jumlah_soal_pg' => 'required',
            'jumlah_soal_essai' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'durasi' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        // ambil data butir soal yang soal id nya telah dipilih (multiple choise) count
        $multiple_choice = ButirSoal::where('soal_id', $request->soal_id)->where('jenis_soal', 'multiple-choice')->count();

        // ambil data butir soal yang soal id nya telah dipilih (pilihan ganda coise) count
        $single_choice = ButirSoal::where('soal_id', $request->soal_id)->where('jenis_soal', 'single-choice')->count();


        if ($request->jumlah_soal_pg > $multiple_choice) {
            return response()->json([
                'multiple_choice' => true,
                'message' => 'Jumlah pilihan ganda melebihi maksimum butir soal'
            ]);
        }

        if ($request->jumlah_soal_essai > $single_choice) {
            return response()->json([
                'single_choice' => true,
                'message' => 'Jumlah essai melebihi maksimum butir soal'
            ]);
        }

        $pengaturan_kuis = PengaturanKuis::create([
            'sekolah_id' => auth()->user()->id_sekolah,
            'is_hide_title' => $request["is_hide_title"] ? 1 : 0,
            'restart_quiz' => $request["restart_quiz"] ? 1 : 0,
            'random_question' => $request["random_question"] ? 1 : 0,
            'random_option' => $request["random_option"] ? 1 : 0,
            'statistic' => $request["statistic"] ? 1 : 0,
            'take_quiz_only_once' => $request["take_quiz_only_once"] ? 1 : 0,
            'only_show_specific_question' => $request["only_show_specific_question"] ? 1 : 0,
            'many_questions_should_be_displayed' => $request["many_questions_should_be_displayed"] ?? 0,
            'skip_question' => $request["skip_question"] ? 1 : 0,
            'autostart' => $request["autostart"] ? 1 : 0,
            'only_registered' => $request["only_registered"] ? 1 : 0,
            'show_point' => $request["show_point"] ? 1 : 0,
            'with_number_in_option' => $request["with_number_in_option"] ? 1 : 0,
            'show_correct_option' => $request["show_correct_option"] ? 1 : 0,
            'answer_mark' => $request["answer_mark"] ? 1 : 0,
            'force_answer' => $request["force_answer"] ? 1 : 0,
            'hide_numbering' => $request["hide_numbering"] ? 1 : 0,
            'show_average_point' => $request["show_average_point"] ? 1 : 0,
            'hide_correct_question' => $request["hide_correct_question"] ? 1 : 0,
            'hide_quiz_time' => $request["hide_quiz_time"] ? 1 : 0,
            'hide_quiz_score' => $request["hide_quiz_score"] ? 1 : 0,
        ]);

        $tanggal_mulai = date('Y-m-d', strtotime($request->tanggal_mulai));
        $tanggal_selesai = date('Y-m-d', strtotime($request->tanggal_selesai));

        $jam_mulai = date('H:i:s', strtotime($request->jam_mulai));
        $jam_selesai = date('H:i:s', strtotime($request->jam_selesai));

        // change zone time
        date_default_timezone_set('Asia/Jakarta');

        $tanggal_terbit = date('Y-m-d');

        if (!empty($request->tanggal_terbit)) {
            $tanggal_terbit = date('Y-m-d', strtotime($request->tanggal_terbit));
        }

        $jam_terbit = date('h:i:s');
        if (!empty($request->jam_terbit)) {
            $jam_terbit = date('h:i:s', strtotime($request->jam_terbit));
        }

        Kuis::create([
            'sekolah_id' => auth()->user()->id_sekolah,
            'soal_id' => $request->soal_id,
            'pengaturan_kuis_id' => $pengaturan_kuis->id,
            'durasi' => $request->durasi,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'jumlah_soal_pg' => $request->jumlah_soal_pg,
            'jumlah_soal_essai' => $request->jumlah_soal_essai,
            'guru_id' => $request->guru_id,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jenis_kuis' => $request->jenis_kuis,
            'jam_terbit' => $jam_terbit,
            'tanggal_terbit' => $tanggal_terbit,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    public function edit($id){
        $kuis = Kuis::findOrFail($id);

        return response()
            ->json([
                'id'   => $kuis->id,
                'soal_id'   => $kuis->soal_id,
                'pengaturan_kuis_id'   => $kuis->pengaturan_kuis_id,
                'durasi'   => $kuis->durasi,
                'jumlah_soal_pg' => $kuis->jumlah_soal_pg,
                'jumlah_soal_essai' => $kuis->jumlah_soal_essai,
                'tanggal_mulai' => $kuis->tanggal_mulai,
                'tanggal_selesai' => $kuis->tanggal_selesai,
                'jam_mulai' => $kuis->jam_mulai,
                'jam_selesai' => $kuis->jam_selesai,
                'guru_id'   => $kuis->guru_id,
                'status'   => $kuis->status,
                'keterangan' => $kuis->keterangan,
                'jenis_kuis' => $kuis->jenis_kuis
            ]);
    }

    public function update(Request $request){
        $data = $request->all();

        $rules = [
            'soal_id' => 'required',
            'guru_id' => 'required',
            'jenis_kuis' => 'required',
            'keterangan' => 'required',
            'jumlah_soal_pg' => 'required',
            'jumlah_soal_essai' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'durasi' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $kuis = Kuis::findOrFail($request->hidden_id);

        // change zone time
        date_default_timezone_set('Asia/Jakarta');

        $tanggal_mulai = date('Y-m-d', strtotime($request->tanggal_mulai));
        $tanggal_selesai = date('Y-m-d', strtotime($request->tanggal_selesai));

        $jam_mulai = date('H:i:s', strtotime($request->jam_mulai));
        $jam_selesai = date('H:i:s', strtotime($request->jam_selesai));

        // change zone time
        date_default_timezone_set('Asia/Jakarta');

        $tanggal_terbit = date('Y-m-d');

        if (!empty($request->tanggal_terbit)) {
            $tanggal_terbit = date('Y-m-d', strtotime($request->tanggal_terbit));
        }

        $jam_terbit = date('h:i:s');
        if (!empty($request->jam_terbit)) {
            $jam_terbit = date('h:i:s', strtotime($request->jam_terbit));
        }

        $kuis->update([
            'soal_id' => $request->soal_id,
            'durasi' => $request->durasi,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'jumlah_soal_pg' => $request->jumlah_soal_pg,
            'jumlah_soal_essai' => $request->jumlah_soal_essai,
            'guru_id' => $request->guru_id,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jenis_kuis' => $request->jenis_kuis,
            'jam_terbit' => $jam_terbit,
            'tanggal_terbit' => $tanggal_terbit,
        ]);
        $pengaturan_kuis = PengaturanKuis::findOrFail($kuis->pengaturan_kuis_id);

        $pengaturan_kuis->update([
            'sekolah_id' => auth()->user()->id_sekolah,
            'is_hide_title' => $request["is_hide_title"] ? 1 : 0,
            'restart_quiz' => $request["restart_quiz"] ? 1 : 0,
            'random_question' => $request["random_question"] ? 1 : 0,
            'random_option' => $request["random_option"] ? 1 : 0,
            'statistic' => $request["statistic"] ? 1 : 0,
            'take_quiz_only_once' => $request["take_quiz_only_once"] ? 1 : 0,
            'only_show_specific_question' => $request["only_show_specific_question"] ? 1 : 0,
            'many_questions_should_be_displayed' => $request["many_questions_should_be_displayed"] ?? 0,
            'skip_question' => $request["skip_question"] ? 1 : 0,
            'autostart' => $request["autostart"] ? 1 : 0,
            'only_registered' => $request["only_registered"] ? 1 : 0,
            'show_point' => $request["show_point"] ? 1 : 0,
            'with_number_in_option' => $request["with_number_in_option"] ? 1 : 0,
            'show_correct_option' => $request["show_correct_option"] ? 1 : 0,
            'answer_mark' => $request["answer_mark"] ? 1 : 0,
            'force_answer' => $request["force_answer"] ? 1 : 0,
            'hide_numbering' => $request["hide_numbering"] ? 1 : 0,
            'show_average_point' => $request["show_average_point"] ? 1 : 0,
            'hide_correct_question' => $request["hide_correct_question"] ? 1 : 0,
            'hide_quiz_time' => $request["hide_quiz_time"] ? 1 : 0,
            'hide_quiz_score' => $request["hide_quiz_score"] ? 1 : 0,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    public function destroy($id, Request $request){
        $kuis = Kuis::findOrFail($id);

        $kuis->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
