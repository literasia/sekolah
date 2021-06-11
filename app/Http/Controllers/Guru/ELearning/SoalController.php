<?php

namespace App\Http\Controllers\Guru\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, MataPelajaran, Siswa};
use App\Models\Admin\{Kelas, Soal};
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
{
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $mata_pelajaran = MataPelajaran::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $kelas = Kelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        if ($request->ajax())
        {
            $guru = Guru::where('user_id', auth()->user()->id)->first();
            $soal = Soal::where('sekolah_id', auth()->user()->id_sekolah)
                        ->where('guru_id', $guru->id)->latest()->get();

            return DataTables::of($soal)
                ->addColumn('action', function ($soal) {
                    $button = '<button type="button" data-id="'.$soal->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$soal->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('mata_pelajaran', function($soal){
                    return $soal->mataPelajaran->nama_pelajaran;
                })
                ->addColumn('kelas', function($soal){
                    return $soal->kelas->tingkatanKelas->name." - ".$soal->kelas->name;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('guru.e-learning.soal')
                                    ->with('kelas', $kelas)
                                    ->with('mata_pelajaran', $mata_pelajaran)
                                    ->with('mySekolah', User::sekolah())
                                    ->with('addons', $addons);
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'judul' => 'required',
            'mata_pelajaran_id' => 'required|max:100',
            'kelas_id' => 'required|max:100',
        ];
        
        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $guru = Guru::where('user_id', auth()->user()->id)->first();

        Soal::create([
            'sekolah_id' => auth()->user()->id_sekolah,
            'judul' => $request->judul,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'guru_id' => $guru->id,
            'tanggal' => date('Y-m-d'),
        ]);
    
        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    public function edit($id){
        $soal = Soal::findOrFail($id);

        return response()
            ->json([                
                'id'   => $soal->id,
                'judul' => $soal->judul,
                'mata_pelajaran_id' => $soal->mata_pelajaran_id,
                'kelas_id' => $soal->kelas_id,
                'guru_id' => $soal->guru_id,
            ]);
    }   

    public function update(Request $request){
        $data = $request->all();

        $rules = [
            'judul' => 'required',
            'mata_pelajaran_id' => 'required|max:100',
            'kelas_id' => 'required|max:100',
        ];
        
        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $soal = Soal::findOrFail($request->hidden_id);
        
        $soal->update($data);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    public function destroy($id){
        $soal = Soal::findOrFail($id);

        $soal->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
