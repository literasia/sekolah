<?php

namespace App\Http\Controllers\Guru\Elearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, Siswa};
use App\Models\Admin\{HasilKuis, Kuis, Kelas};
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->kelas_id;
        $kuis_id = $request->kuis_id;
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $kelas = Kelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $kuis = Kuis::where('sekolah_id',auth()->user()->id_sekolah)
                    ->where('guru_id', $guru->id)->latest()->get();

        if($request->ajax()){

            $hasil_kuis = HasilKuis::whereHas('kuis', function($query){
                $query->where('sekolah_id', auth()->user()->id_sekolah);
            });

            if(!empty($request->kelas_id)){
                $kelas_id = $request->kelas_id;
                $hasil_kuis->whereHas('siswa', function($query) use($kelas_id){
                    $query->where('kelas_id', $kelas_id);
                });
            }

            if(!empty($request->kuis_id)){
                $hasil_kuis->where('kuis_id', $request->kuis_id);
            }

            $hasil_kuis = $hasil_kuis->get();

                return DataTables::of($hasil_kuis)
                    ->addColumn('action', function ($hasil_kuis) {
                        $button = '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$hasil_kuis->id.'" class="preview btn-warning btn-mini">cek essai</button>';
                        return $button;
                    })
                    ->editColumn('siswa', function($hasil_kuis){
                        $input = '<input type="hidden" value="'.$hasil_kuis->id.'" name="hidden_id[]" id="hidden_id">';
                        return $input.' '.$hasil_kuis->siswa->nama_lengkap;
                    })
                    ->editColumn('jumlah_benar', function($hasil_kuis){
                        return $hasil_kuis->jumlah_benar;
                    })
                    ->editColumn('jumlah_salah', function($hasil_kuis){
                        return $hasil_kuis->jumlah_salah;
                    })
                    ->editColumn('nilai_pilgan', function($hasil_kuis){
                        return $hasil_kuis->nilai;
                    })
                    ->addColumn('nilai_essai', function ($hasil_kuis) {
                        $input = '<input type="number" name="nilai_essai[]" id="nilai_essai" data-id="'.$hasil_kuis->id.'" value ="'.$hasil_kuis->nilai_essai.'"class="nilai_essai col-8 form-control form-control-sm">';
                        return $input;
                    })
                    ->editColumn('nilai_total', function($hasil_kuis){
                        $pilgan = $hasil_kuis->nilai;
                        $essai = $hasil_kuis->nilai_essai;
                        $nilai_total = $pilgan + $essai;
                        return $nilai_total;
                    })
                    
                    
                    ->rawColumns(['action','nilai_essai','siswa'])
                    ->addIndexColumn()
                    ->make(true);
        }

        
        return view('guru.e-learning.nilai')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('addons', $addons)
                                    ->with('kelas', $kelas)
                                    ->with('kuis', $kuis)
                                    ->with('kelas_id', $kelas_id)
                                    ->with('kuis_id', $kuis_id);
    }

    public function edit($id) {
        $hasil_kuis = HasilKuis::find($id);

        return response()
            ->json([
                'nilai_essai' => $hasil_kuis
            ]);
    }

    public function update(Request $request){
        $data = $request->all();

        dd($data);
        $rules = [
            'nilai_essai'  => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        HasilKuis::whereId($request->hidden_id)->update([
            'nilai_essai'  => $request->input('nilai_essai'),
        ]);

        return response()
            ->json([
                'success'   => 'Data Updated.',
            ]);
    }

    public function store(Request $request){
        $ids = $request->hidden_id;
        $nilai_essai = $request->nilai_essai;
        // data diatas berupa array.
        // dd($ids);
        // coba hidupkan dd nya diatas biar tau hasil dari input yang ada name array name="hidden_id[]" jadinya gimana

        // buat perulangan dari ids tersebut pake for biasa
        // update data nya di hasil ujian
    }

    
}
