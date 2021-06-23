<?php

namespace App\Http\Controllers\Admin\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PengaturanKuis;
use App\Models\Admin\Penilaian;
use App\Models\Admin\{CbtSoal,CbtButirSoal,Ujian};
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UjianController extends Controller
{
    public function index(Request $request)
    {
        // $addons = Addons::where('user_id', auth()->user()->id)->first();
        // return view('admin.cbt.ujian',['mySekolah' => User::sekolah(), 'addons' => $addons]); 
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $soal = CbtSoal::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $penilaian = Penilaian::all();

        if ($request->ajax())
        {
            $ujian = Ujian::where('sekolah_id', auth()->user()->id_sekolah)->latest()->get();
            return DataTables::of($ujian)
                ->addColumn('action', function ($ujian) {
                    $button = '<button type="button" data-id="'.$ujian->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$ujian->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('paket_soal', function($ujian){
                    return $ujian->soal->judul;
                })
                ->addColumn('durasi', function($ujian){
                    $durasi = '<label class="badge badge-info m-1">'.$ujian->durasi.' Menit</label';
                    return $durasi;
                })
                ->editColumn('status', function($ujian){
                    if ($ujian->status == "Draf") {
                        return '<label class="badge badge-warning m-0">Draf</label>';
                    }

                    if ($ujian->status == "Terbitkan") {
                        return '<label class="badge badge-success m-0">Terbit</label>';
                    }
                })
                ->editColumn('jumlah_soal_pg', function($ujian){
                    $soal_pg = '<center><label class="badge badge-danger py-2 px-3">'.$ujian->jumlah_soal_pg.'</label></center>';
                    return $soal_pg;
                })
                ->editColumn('jumlah_soal_essai', function($ujian){
                    $soal_essai = '<center><label class="badge badge-primary py-2 px-3">'.$ujian->jumlah_soal_essai.'</label></center>';
                    return $soal_essai;
                })
                ->editColumn('keterangan', function($ujian){
                    return strlen($ujian->keterangan) > 30 ? substr(strip_tags($ujian->keterangan), 0, 30)."..." : $ujian->keterangan;
                })
                ->rawColumns(['action', 'status', 'jumlah_soal_essai', 'jumlah_soal_pg', 'durasi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.cbt.ujian')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('addons', $addons)
                                    ->with('soal', $soal)
                                    ->with('penilaians', $penilaian);
    }

    public function store(Request $request){
        $data = $request->all();
        // return response()->json($data);
        $rules = [
            'soal_id' => 'required',
            'keterangan' => 'required',
            'jumlah_soal_pg' => 'required',
            'jumlah_soal_essai' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'durasi' => 'required',
            'status' => 'required',
            'penilaian_id' => 'required',
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
        $multiple_choice = CbtButirSoal::where('soal_id', $request->soal_id)->where('jenis_soal', 'multiple-choice')->count();

        // ambil data butir soal yang soal id nya telah dipilih (pilihan ganda coise) count
        $single_choice = CbtButirSoal::where('soal_id', $request->soal_id)->where('jenis_soal', 'single-choice')->count();


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



        Ujian::create([
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
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jam_terbit' => $jam_terbit,
            'tanggal_terbit' => $tanggal_terbit,
            'penilaian_id' => $request->penilaian_id,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    public function edit($id){
        $ujian = Ujian::findOrFail($id);
        $pengaturan = PengaturanKuis::findOrFail($ujian->pengaturan_kuis_id);
        // $penilaian = Penilaian::findOrFail($id);

        return response()
            ->json([
                'id'   => $ujian->id,
                'soal_id'   => $ujian->soal_id,
                'pengaturan_kuis_id'   => $ujian->pengaturan_kuis_id,
                'durasi'   => $ujian->durasi,
                'jumlah_soal_pg' => $ujian->jumlah_soal_pg,
                'jumlah_soal_essai' => $ujian->jumlah_soal_essai,
                'tanggal_mulai' => $ujian->tanggal_mulai,
                'tanggal_selesai' => $ujian->tanggal_selesai,
                'jam_mulai' => $ujian->jam_mulai,
                'jam_selesai' => $ujian->jam_selesai,
                'status'   => $ujian->status,
                'keterangan' => $ujian->keterangan,
                'pengaturan' => $pengaturan,
                // 'penilaian_id' => $ujian->penilaian_id,
            ]);
    }
    public function update(Request $request){
        $data = $request->all();

        $rules = [
            'soal_id' => 'required',
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

        $ujian = Ujian::findOrFail($request->hidden_id);
        // $penilaian = Penilaian::findOrFail($request->hidden_id);

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



        $ujian->update([
            'soal_id' => $request->soal_id,
            'durasi' => $request->durasi,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'jumlah_soal_pg' => $request->jumlah_soal_pg,
            'jumlah_soal_essai' => $request->jumlah_soal_essai,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jam_terbit' => $jam_terbit,
            'tanggal_terbit' => $tanggal_terbit,
        ]);
        $pengaturan_kuis = PengaturanKuis::findOrFail($ujian->pengaturan_kuis_id);

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
        $ujian = Ujian::findOrFail($id);

        $ujian->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}