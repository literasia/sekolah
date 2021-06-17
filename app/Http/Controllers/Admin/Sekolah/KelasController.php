<?php

namespace App\Http\Controllers\Admin\Sekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Kelas;
use App\Models\TingkatanKelas;
use App\Models\{Pegawai, Guru};
use App\Models\Admin\Jurusan;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Yajra\DataTables\DataTables;
use Exeption;
use App\Models\Superadmin\Addons;


class KelasController extends Controller
{
    //readd
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        if ($request->ajax()) {
            // $data = Guru::latest()->get();
            // $data = Kelas::join('pegawais', 'kelas.pegawai_id', 'pegawais.id')
            //     ->whereHas('user', function($query){
            //         $query->where('id_sekolah', auth()->user()->id_sekolah);
            //     })
            //     ->join('jurusans', 'kelas.jurusan_id', 'jurusans.id')
            //     ->get(['kelas.*', 'jurusans.name AS jurusan']);
            // $data = Kelas::all();
            // return($data);
            
            $data = Kelas::whereHas('user', function($query){
                    $query->where('id_sekolah', auth()->user()->id_sekolah);
                })
                ->get();
                
                
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" data-id="' . $data->id . '" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('jurusan', function($data){
                      if(!empty($data->jurusan->name)){
                        return $data->jurusan->name;
                    }else {
                        return "Data Pegawai Tidak Ditemukan";
                    }
                })
                ->addColumn('wali_kelas', function($data){
                    if(!empty($data->pegawai->name)){
                        return $data->pegawai->name;
                    }else {
                        return "Data Pegawai Tidak Ditemukan";
                    }
                })
                ->rawColumns(['action', 'wali_kelas'])
                ->addIndexColumn()
                ->make(true);
        }
        
        $pegawai = Pegawai::join('gurus', 'pegawais.id', 'gurus.pegawai_id')
            ->whereHas('user', function($query){
                $query->where('id_sekolah', auth()->user()->id_sekolah);
            })->get();
        // $gurus = Guru::where('user_id', Auth::id())->get();
        $gurus = Guru::join('pegawais', 'gurus.pegawai_id', 'pegawais.id')
            ->whereHas('user', function($query){
                $query->where('id_sekolah', auth()->user()->id_sekolah);
            })->get(['gurus.*', 'pegawais.name AS name']);
        $tingkat = TingkatanKelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->latest()->get();
        $jurusan = Jurusan::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->latest()->get();

        // return($gurus);

        return view('admin.sekolah.kelas',['tingkat' => $tingkat, 'addons' => $addons, 'jurusan' => $jurusan, 'gurus' => $gurus, 'mySekolah' => User::sekolah()]);
    }

    public function store(Request $request)
    {
        // validasi
        $rules = [
            'name'  => 'required|max:100',
            'tingkat'  => 'required|max:100',
            'jurusan'  => 'nullable|max:100',
            'kapasitas' => 'nullable',
            'keterangan' => 'nullable',
        ];

        $message = [
            'name.required' => 'Kolom ini tidak boleh kosong',
            'tingkat.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Kelas::create([
            'name' => $request->input('name'),
            'tingkatan_kelas_id' => $request->input('tingkat'),
            'pegawai_id' => $request->input('wali_kelas'),
            'jurusan_id' => $request->input('jurusan') ? $request->input('jurusan') : NULL,
            'kapasitas' => $request->input('kapasitas'),
            'keterangan' => $request->input('keterangan'),
            'user_id' => Auth::id()
        ]);

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $kelas = Kelas::find($id);

        return response()
            ->json([
                'kelas' => $kelas,
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'name'  => 'required|max:100',
            'tingkat'  => 'required|max:100',
            'jurusan'  => 'nullable|max:100',
            'kapasitas' => 'nullable',
            'keterangan' => 'nullable',
        ];

        $message = [
            'name.required' => 'Kolom ini tidak boleh kosong',
            'tingkat.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Kelas::whereId($request->hidden_id)->update([
            'name' => $request->input('name'),
            'tingkatan_kelas_id' => $request->input('tingkat'),
            'pegawai_id' => $request->input('wali_kelas'),
            'jurusan_id' => $request->input('jurusan')??"",
            'kapasitas' => $request->input('kapasitas'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return response()
            ->json([
                'success'   => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $pegawai = Kelas::find($id);
        $pegawai->delete();
    }
}
