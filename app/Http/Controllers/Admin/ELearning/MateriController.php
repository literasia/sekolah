<?php

namespace App\Http\Controllers\Admin\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, MataPelajaran};
use App\Models\Admin\{Kelas, Materi};
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MateriController extends Controller
{ //
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $mata_pelajaran = MataPelajaran::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $guru = Guru::whereHas('user', function($query) {
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();
        $kelas = Kelas::whereHas('user', function($query) {
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        if ($request->ajax())
        {
            $materi = Materi::where('sekolah_id', auth()->user()->id_sekolah)->latest()->get();
            return DataTables::of($materi)
                ->addColumn('action', function ($materi) {
                    $button = '<button type="button" data-id="'.$materi->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$materi->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('mata_pelajaran', function($materi){
                    return $materi->mataPelajaran->nama_pelajaran;
                })
                ->addColumn('kelas', function($materi){
                    return $materi->kelas->tingkatanKelas->name." - ".$materi->kelas->name;
                })
                ->addColumn('guru', function($materi){
                    return $materi->guru->pegawai->name;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('admin.e-learning.materi')
                                    ->with('mySekolah', auth()->user()->sekolah())
                                    ->with('addons', $addons)
                                    ->with('guru', $guru)
                                    ->with('kelas', $kelas)
                                    ->with('mata_pelajaran', $mata_pelajaran);  
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'id_sekolah'    => 'max:100',
            'judul' => 'required',
            'mata_pelajaran_id' => 'required|max:100',
            'kelas_id' => 'required|max:100',
            'guru_id' => 'required|max:100',
            'materi' => 'required|',
            'status' => 'required|max:100',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $data['sekolah_id'] = auth()->user()->id_sekolah;
        
        // change zone time
        date_default_timezone_set('Asia/Jakarta');
        
        if (empty($data['tanggal_terbit'])) {
            $data['tanggal_terbit'] = date('Y-m-d');    
        }else{
            $data['tanggal_terbit'] = date('Y-m-d', strtotime($request->tanggal_terbit));
        }

        if (empty($data['jam_terbit'])) {
            $data['jam_terbit'] = date('h:i:s'); 
        }else{
            $data['jam_terbit'] = date('h:i:s', strtotime($request->jam_terbit));
        }

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

        $rules = [
            'id_sekolah'    => 'max:100',
            'judul' => 'required',
            'mata_pelajaran_id' => 'required|max:100',
            'kelas_id' => 'required|max:100',
            'guru_id' => 'required|max:100',
            'materi' => 'required|',
            'status' => 'required|max:100',
        ];

        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        // change zone time
        date_default_timezone_set('Asia/Jakarta');

        if (empty($data['tanggal_terbit'])) {
            $data['tanggal_terbit'] = date('Y-m-d');    
        }else{
            $data['tanggal_terbit'] = date('Y-m-d', strtotime($request->tanggal_terbit));
        }

        if (empty($data['jam_terbit'])) {
            $data['jam_terbit'] = date('h:i:s'); 
        }else{
            $data['jam_terbit'] = date('h:i:s', strtotime($request->jam_terbit));
        }
        
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
