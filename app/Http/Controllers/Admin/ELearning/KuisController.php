<?php

namespace App\Http\Controllers\Admin\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Kuis, Soal, PengaturanKuis};
use App\Models\Guru;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;

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
                ->addColumn('mata_pelajaran', function($kuis){
                    return $kuis->soal->mataPelajaran->nama_pelajaran;
                })
                ->addColumn('kelas', function($kuis){
                    return $kuis->soal->kelas->name;
                })
                ->addColumn('guru', function($kuis){
                    return $kuis->guru->pegawai->name;
                })
                ->rawColumns(['action'])
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
        $pengaturan_kuis = PengaturanKuis::create([
            'is_hide_title' => 0,
            'sekolah_id' => auth()->user()->id_sekolah,
        ]);

        Kuis::create([
            'sekolah_id' => auth()->user()->id_sekolah,
            'soal_id' => $request->soal_id,
            'pengaturan_kuis_id' => $pengaturan_kuis->id,
            'durasi' => $request->durasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'guru_id' => $request->guru_id,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'jenis_kuis' => $request->jenis_kuis,
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
                'tanggal_mulai'   => $kuis->tanggal_mulai,
                'tanggal_selesai'   =>  $kuis->tanggal_selesai,
                'guru_id'   => $kuis->guru_id,
                'status'   => $kuis->status,
                'keterangan' => $kuis->keterangan,
                'jenis_kuis' => $kuis->jenis_kuis
            ]);
    }   

    public function update(Request $request){
        $kuis = Kuis::findOrFail($request->hidden_id);
        
        $kuis->update($request->all());

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
