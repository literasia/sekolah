<?php

namespace App\Http\Controllers\Guru\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, MataPelajaran};
use App\Models\Admin\{Kelas, Materi};
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MateriController extends Controller
{ 
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $mata_pelajaran = MataPelajaran::where('sekolah_id', auth()->user()->id_sekolah)->get();
        $kelas = Kelas::whereHas('user', function($query) {
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        if ($request->ajax())
        {
            $guru = Guru::where('user_id', auth()->user()->id)->first();

            $materi = Materi::where('sekolah_id', auth()->user()->id_sekolah)
                            ->where('guru_id', $guru->id)->latest()->get();
                            
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
                ->editColumn('status', function($materi){
                    if ($materi->status == "Draf") {
                        return '<label class="badge badge-warning m-0">Draf</label>';
                    }

                    if ($materi->status == "Terbitkan") {
                        return '<label class="badge badge-success m-0">Terbit</label>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('guru.e-learning.materi')
                                    ->with('mySekolah', auth()->user()->sekolah())
                                    ->with('addons', $addons)
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
            'materi' => 'required|',
            'status' => 'required|max:100',
            'keterangan' => 'required|',
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
        
        $tanggal_terbit = date('Y-m-d');
        if (!empty($data['tanggal_terbit'])) {
            $tanggal_terbit = date('Y-m-d', strtotime($request->tanggal_terbit));
        }

        $jam_terbit = date('h:i:s'); 
        if (empty($data['jam_terbit'])) {
            $jam_terbit = date('h:i:s', strtotime($request->jam_terbit));
        }

        $guru = Guru::where('user_id', auth()->user()->id)->first();

        // Add Photo to public
        $request['media'] = null;
        if ($request->file('media')) {
            $data['media'] = $request->file('media')->store('media_materi', 'public');
        }
  

        Materi::create([
            'judul' => $request->judul,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'guru_id' => $guru->id,
            'sekolah_id' => auth()->user()->id_sekolah,
            'materi' => $request->materi,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'tanggal_terbit' => $tanggal_terbit,
            'jam_terbit' => $jam_terbit,
            'media' => $request['media'],
        ]);
    
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
        $data = $request->all();
        $materi = Materi::findOrFail($request->hidden_id);

        $rules = [
            'id_sekolah'    => 'max:100',
            'judul' => 'required',
            'mata_pelajaran_id' => 'required|max:100',
            'kelas_id' => 'required|max:100',
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
    
        $tanggal_terbit = date('Y-m-d');
        if (!empty($data['tanggal_terbit'])) {
            $tanggal_terbit = date('Y-m-d', strtotime($request->tanggal_terbit));
        }

        $jam_terbit = date('h:i:s'); 
        if (empty($data['jam_terbit'])) {
            $jam_terbit = date('h:i:s', strtotime($request->jam_terbit));
        }

        $data['media'] = $pegawai->media;

        // Request new photo
        if ($request->file('media')) {
            // Insert new photo
            $data['media'] = $request->file('media')->store('media_materi', 'public');
            // if exist same file photo delete it
            if ($request->file('media') && $currFoto && Storage::disk('public')->exists($currFoto)) {
                Storage::disk('public')->delete($currFoto);
            }
        } 
        
        $materi->update([
            'judul' => $request->judul,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'sekolah_id' => auth()->user()->id_sekolah,
            'materi' => $request->materi,
            'status' => $request->status,
            'tanggal_terbit' => $tanggal_terbit,
            'jam_terbit' => $jam_terbit,
            'media' => $data['media'],
        ]);

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
