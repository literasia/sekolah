<?php

namespace App\Http\Controllers\Admin\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, MataPelajaran, Siswa};
use App\Models\Admin\{Kelas, Soal};
use App\Models\Admin\CbtSoal;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SoalUjianController extends Controller
{
    // public function index(Request $request)
    // {
    //     $addons = Addons::where('user_id', auth()->user()->id)->first();
    //     return view('admin.cbt.soal-ujian',['mySekolah' => User::sekolah(), 'addons' => $addons]); 
    // }

    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $mata_pelajaran = MataPelajaran::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $kelas = Kelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        if ($request->ajax())
        {
            $cbt_soal = CbtSoal::where('sekolah_id', auth()->user()->id_sekolah)->latest()->get();
            return DataTables::of($cbt_soal)
                ->addColumn('action', function ($cbt_soal) {
                    $button = '<button type="button" data-id="'.$cbt_soal->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$cbt_soal->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('mata_pelajaran', function($cbt_soal){
                    return $cbt_soal->mataPelajaran->nama_pelajaran;
                })
                ->addColumn('kelas', function($cbt_soal){
                    return $cbt_soal->kelas->tingkatanKelas->name." - ".$cbt_soal->kelas->name;
                })
                
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('admin.cbt.soal-ujian')
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

        CbtSoal::create([
            'sekolah_id' => auth()->user()->id_sekolah,
            'judul' => $request->judul,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'tanggal' => date('Y-m-d'),
        ]);
    
        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    public function edit($id){
        $cbt_soal = CbtSoal::findOrFail($id);

        return response()
            ->json([                
                'id'   => $cbt_soal->id,
                'judul' => $cbt_soal->judul,
                'mata_pelajaran_id' => $cbt_soal->mata_pelajaran_id,
                'kelas_id' => $cbt_soal->kelas_id,
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

        $cbt_soal = CbtSoal::findOrFail($request->hidden_id);
        
        $cbt_soal->update($data);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    public function destroy($id){
        $cbt_soal = CbtSoal::findOrFail($id);

        $cbt_soal->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
