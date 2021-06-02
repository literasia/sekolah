<?php

namespace App\Http\Controllers\Admin\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Admin\{Soal, ButirSoal, Kelas};
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ButirSoalController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->kelas_id;
        $soal_id = $request->soal_id;
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $kelas = Kelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        $soal = Soal::where('sekolah_id', auth()->user()->id_sekolah)->get();
        
        if ($request->ajax())
        {
            $butir_soal = ButirSoal::whereHas('soal', function($query){
                $query->where('sekolah_id', auth()->user()->id_sekolah);
            });
    
            if (!empty($request->kelas_id)) {
                $kelas_id = $request->kelas_id;
                $butir_soal->whereHas('soal', function($query) use($kelas_id){
                    $query->where('kelas_id', $kelas_id);
                });
            }
    
            if (!empty($request->soal_id)) {
                $butir_soal->where('soal_id', $request->soal_id);
            }

            $butir_soal = $butir_soal->get();
    
            return DataTables::of($butir_soal)
                ->addColumn('action', function ($butir_soal) {
                    $button = '<button type="button" data-id="'.$butir_soal->id.'" class="preview btn btn-mini btn-warning shadow-sm"><i class="fa fa-eye"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$butir_soal->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$butir_soal->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->editColumn('pertanyaan', function($butir_soal){
                    return substr(strip_tags($butir_soal->pertanyaan), 0, 14).'...';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

    
        return view('admin.e-learning.butir-soal')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('kelas', $kelas)
                                    ->with('soal', $soal)
                                    ->with('kelas_id', $kelas_id)
                                    ->with('soal_id', $soal_id)
                                    ->with('addons', $addons);  
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'poin' => 'required',
            'jenis_soal' => 'required',
            'pertanyaan' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $jawaban = null;

        if (!empty($request->jawaban)) {
            $jawaban = implode('|literasia_sekolah|' ,$request->jawaban);
        }

        ButirSoal::create([
            'soal_id' => $request->soal_id,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $jawaban,
            'jenis_soal' => $request->jenis_soal,
            'kunci_jawaban' => $request->kunci_jawaban,
            'poin' => $request->poin,
        ]);
    
        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    public function edit($id){
        $butir_soal = ButirSoal::findOrFail($id);

        $jawaban = explode('|literasia_sekolah|', $butir_soal->jawaban);

        return response()
            ->json([                
                'id'   => $butir_soal->id,
                'soal_id'   => $butir_soal->soal_id,
                'jenis_soal'   => $butir_soal->jenis_soal,
                'pertanyaan'   => $butir_soal->pertanyaan,
                'jawaban'   => $jawaban,
                'kunci_jawaban'   => $butir_soal->kunci_jawaban,
            ]);
    }

    public function update(Request $request){
        $data = $request->all();
        
        $rules = [
            'poin' => 'required',
            'jenis_soal' => 'required',
            'pertanyaan' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $butir_soal = ButirSoal::findOrFail($request->hidden_id);
        $jawaban = implode('|literasia_sekolah|' ,$request->jawaban);
        
        $butir_soal->update([
            'soal_id' => $request->soal_id,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $jawaban,
            'jenis_soal' => $request->jenis_soal,
            'kunci_jawaban' => $request->kunci_jawaban,
            'poin' => $request->poin,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    public function destroy($id, Request $request){
        $butir_soal = ButirSoal::findOrFail($id);

        $butir_soal->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
