<?php

namespace App\Http\Controllers\Guru\ELearning;

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
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $soal = Soal::where('sekolah_id', auth()->user()->id_sekolah)
                        ->where('guru_id', $guru->id)->latest()->get();

        if ($request->ajax())
        {
            $guru = Guru::where('user_id', auth()->user()->id)->first();
            $kuis = Kuis::where('sekolah_id', auth()->user()->id_sekolah)->where('guru_id', $guru->id)->latest()->get();
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
                    $durasi = '<label class="badge badge-info m-1">'.$kuis->durasi.' Menit</label';
                    return $durasi;
                })
                ->editColumn('status', function($kuis){
                    if ($kuis->status == "Draf") {
                        return '<label class="badge badge-warning m-0">Draf</label>';
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
                    $soal_pg = '<center><label class="badge badge-danger py-2 px-3">'.$kuis->jumlah_soal_pg.'</label></center>';
                    return $soal_pg;
                })
                ->editColumn('jumlah_soal_essai', function($kuis){
                    $soal_essai = '<center><label class="badge badge-primary py-2 px-3">'.$kuis->jumlah_soal_essai.'</label></center>';
                    return $soal_essai;
                })
                ->editColumn('keterangan', function($kuis){
                    return strlen($kuis->keterangan) > 30 ? substr(strip_tags($kuis->keterangan), 0, 30)."..." : $kuis->keterangan;
                })
                ->rawColumns(['action', 'status', 'jenis_kuis', 'jumlah_soal_essai', 'jumlah_soal_pg', 'durasi'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('guru.e-learning.kuis')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('addons', $addons)
                                    ->with('guru', $guru)
                                    ->with('soal', $soal);
    }

    public function store(Request $request){
        $data = $request->all();
        
        $rules = [
            'soal_id' => 'required',
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
            'is_hide_title' => 0,
            'sekolah_id' => auth()->user()->id_sekolah,
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

        $guru = Guru::where('user_id', auth()->user()->id)->first();

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
            'guru_id' => $guru->id,
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

        $guru = Guru::where('user_id', auth()->user()->id)->first();

        $kuis->update([
            'soal_id' => $request->soal_id,
            'durasi' => $request->durasi,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'jumlah_soal_pg' => $request->jumlah_soal_pg,
            'jumlah_soal_essai' => $request->jumlah_soal_essai,
            'guru_id' => $guru->id,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jenis_kuis' => $request->jenis_kuis,
            'jam_terbit' => $jam_terbit,
            'tanggal_terbit' => $tanggal_terbit,
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
