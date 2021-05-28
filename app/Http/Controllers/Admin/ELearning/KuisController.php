<?php

namespace App\Http\Controllers\Admin\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Kuis, Soal};
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
                                    ->with('soal', $soal);
    }

    public function store(Request $request){
        $data = $request->all();
        $data['sekolah_id'] = auth()->user()->id_sekolah;

        Materi::create($data);
    
        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    public function edit($id){
        $materi = Materi::findOrFail($id);

        return response()
            ->json([                
                'id'   => $materi->id,
                'judul'   => $materi->judul,
                'mata_pelajaran_id'   => $materi->mata_pelajaran_id,
                'kelas_id'   => $materi->kelas_id,
                'guru_id'   => $materi->guru_id,
                'sekolah_id'   => $materi->sekolah_id,
                'materi'   => $materi->materi,
                'status'   => $materi->status,
                'tanggal_terbit'   => $materi->tanggal_terbit,
                'jam_terbit'   => $materi->jam_terbit,
            ]);
    }

    public function update(Request $request){
        $materi = Materi::findOrFail($request->hidden_id);
        
        $materi->update($request->all());

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    public function destroy($id, Request $request){
        $materi = Materi::findOrFail($id);

        $materi->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
