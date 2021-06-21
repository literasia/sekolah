<?php

namespace App\Http\Controllers\Admin\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Admin\{Soal, ButirSoal, Kelas};
use App\Models\Admin\{CbtSoal,CbtButirSoal};
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ButirSoalUjianController extends Controller
{
    public function index(Request $request)
    {
        // $addons = Addons::where('user_id', auth()->user()->id)->first();
        // return view('admin.cbt.butir-soal-ujian',['mySekolah' => User::sekolah(), 'addons' => $addons]);
        $kelas_id = $request->kelas_id;
        $soal_id = $request->soal_id;
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $kelas = Kelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        $cbt_soal = CbtSoal::where('sekolah_id', auth()->user()->id_sekolah)->get();
        
        if ($request->ajax())
        {
            $butir_soal = CbtButirSoal::whereHas('soal', function($query){
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
                    return strlen(strip_tags($butir_soal->pertanyaan)) > 30 ? substr(strip_tags($butir_soal->pertanyaan), 0, 30)."..." : strip_tags($butir_soal->pertanyaan);
                })
                ->editColumn('jenis_soal', function($butir_soal){
                    if ($butir_soal->jenis_soal == "multiple-choice") {
                        return '<p class="text-primary m-0">Multiple Choice</p>';
                    }

                    if ($butir_soal->jenis_soal == "single-choice") {
                        return '<p class="text-success m-0">Single Choice</p>';
                    }
                })
                ->rawColumns(['action', 'jenis_soal'])
                ->addIndexColumn()
                ->make(true);
        }

    
        return view('admin.cbt.butir-soal-ujian')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('kelas', $kelas)
                                    ->with('cbt_soals', $cbt_soal)
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

        CbtButirSoal::create([
            'soal_id' => $request->soal_id,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $jawaban,
            'jenis_soal' => $request->jenis_soal,
            'kunci_jawaban' => $request->kunci_jawaban,
            'poin' => $request->poin,
        ]);
    
        return response()
            ->json([
                'success' => 'Data sukses ditambahkan',
        ]);
    }

    public function edit($id){
        $butir_soal = CbtButirSoal::findOrFail($id);

        $jawaban = explode('|literasia_sekolah|', $butir_soal->jawaban);

        return response()
            ->json([                
                'id'   => $butir_soal->id,
                'soal_id'   => $butir_soal->soal_id,
                'jenis_soal'   => $butir_soal->jenis_soal,
                'pertanyaan'   => $butir_soal->pertanyaan,
                'jawaban'   => $jawaban,
                'kunci_jawaban'   => $butir_soal->kunci_jawaban,
                'poin'  =>  $butir_soal->poin,
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

        $butir_soal = CbtButirSoal::findOrFail($request->hidden_id);
        
        if(!empty($request->jawaban)){
            $jawaban = implode('|literasia_sekolah|' ,$request->jawaban);
        }else{
            $jawaban = null;
        }
        
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
                'success' => 'Data sukses diupdate',
        ]);
    }

    public function destroy($id, Request $request){
        $butir_soal = CbtButirSoal::findOrFail($id);

        $butir_soal->delete();

        return response()
        ->json([
            'success' => 'Data dihapus!',
        ]);
    }
}
