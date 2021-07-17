<?php

namespace App\Http\Controllers\Guru\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{JadwalPelajaran, JamPelajaran, MataPelajaran, TingkatanKelas, Semester};
use App\Models\Admin\Kelas;
use App\User;
use App\Models\Superadmin\Sekolah;

class JadwalPelajaranController extends Controller
{

    public function index(Request $request) {
        $data = null;
        $sekolah = Sekolah::findOrFail(auth()->user()->id_sekolah);
        
        $tahun_ajaran = $request->tahun_ajaran;
        $kelas_id = $request->kelas_id;
        $semester = $request->semester;

        if($request->req == 'table') {
            $data = JadwalPelajaran::with('mataPelajaran')
                                   ->where('tahun_ajaran', $tahun_ajaran)
                                   ->where('kelas_id', $kelas_id)
                                   ->where('semester', $semester)
                                   ->orderBy('jam_pelajaran')
                                   ->get();

            $data = $data->groupBy('hari');
        }elseif($request->req == 'single') {
            $obj = JadwalPelajaran::findOrFail($request->id);
            return response()->json($obj);
        }

        $kelas = Kelas::where('user_id', $request->user()->id)->get();
        $pelajaran = MataPelajaran::join('gurus', 'gurus.id', 'guru_id')
                                    ->join('pegawais', 'pegawais.id', 'gurus.pegawai_id')
                                    ->where('sekolah_id', $request->user()->id_sekolah)
                                    ->selectRaw('mata_pelajarans.id, concat(nama_pelajaran, " | ", name) as name')->get();

        return view('guru.pelajaran.jadwal-pelajaran', compact('kelas_id', 'sekolah', 'semester', 'kelas', 'tahun_ajaran', 'data', 'pelajaran'), ['mySekolah' => User::sekolah()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
