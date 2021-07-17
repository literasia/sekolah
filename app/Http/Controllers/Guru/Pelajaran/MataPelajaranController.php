<?php

namespace App\Http\Controllers\Guru\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\User;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{
    public function index(Request $request) {
        if($request->req == 'table') {
            return DataTables::of(MataPelajaran::join('gurus', 'gurus.id', 'guru_id')
                ->join('pegawais', 'pegawais.id', 'gurus.pegawai_id')
                ->where('mata_pelajarans.sekolah_id', auth()->user()->id_sekolah)
                ->select('mata_pelajarans.*', 'pegawais.name AS nama_guru')
                ->get())->addIndexColumn()->toJson();
        }
        if($request->req == 'single') {
            return response()->json(MataPelajaran::findOrFail($request->id));
        }

        $guru = Guru::join('pegawais', 'gurus.pegawai_id', 'pegawais.id')
            ->whereHas('user', function($query){
                $query->where('id_sekolah', auth()->user()->id_sekolah);
            })
            ->get(['gurus.*', 'pegawais.name AS nama_guru']);
        //TODO: GURU BELUM FILTER BY SEKOLAH //

        return view('guru.pelajaran.mata-pelajaran', array_merge(['mySekolah' => User::sekolah()], compact('guru')));
    }

    public function create()
    {
        //
    }

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
