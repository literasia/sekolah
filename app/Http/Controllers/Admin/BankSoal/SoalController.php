<?php

namespace App\Http\Controllers\Admin\BankSoal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Admin\Kelas;
use App\Models\Admin\BankSoal;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
{ //
    // public function index(Request $request)
    // {
    //     $addons = Addons::where('user_id', auth()->user()->id)->first();
    //     return view('admin.banksoal.soal', ['mySekolah' => User::sekolah(), 'addons' => $addons]);  
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
            $bank_soal = BankSoal::where('sekolah_id', auth()->user()->id_sekolah)->latest()->get();
            return DataTables::of($bank_soal)
                ->addColumn('action', function ($bank_soal) {
                    $button = '<button type="button" data-id="'.$bank_soal->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$bank_soal->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('mata_pelajaran', function($bank_soal){
                    return $bank_soal->mataPelajaran->nama_pelajaran;
                })
                ->addColumn('kelas', function($bank_soal){
                    return $bank_soal->kelas->tingkatanKelas->name." - ".$bank_soal->kelas->name;
                })
                
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('admin.banksoal.soal')
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

        BankSoal::create([
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
        $bank_soal = BankSoal::findOrFail($id);

        return response()
            ->json([                
                'id'   => $bank_soal->id,
                'judul' => $bank_soal->judul,
                'mata_pelajaran_id' => $bank_soal->mata_pelajaran_id,
                'kelas_id' => $bank_soal->kelas_id,
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

        $bank_soal = BankSoal::findOrFail($request->hidden_id);
        
        $bank_soal->update($data);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    public function destroy($id){
        $bank_soal = BankSoal::findOrFail($id);

        $bank_soal->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
