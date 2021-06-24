<?php

namespace App\Http\Controllers\Admin\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class MataPelajaranController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
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

        return view('admin.pelajaran.mata-pelajaran', array_merge(['mySekolah' => User::sekolah()], compact('guru', 'addons')));
    }

    public function write(Request $request) {
        if($request->req == 'write') {
            $obj = MataPelajaran::find($request->id);

            if(!$obj){
                $obj = new MataPelajaran();
            }

            $obj->nama_pelajaran = $request->nama_pelajaran;
            $obj->kode_pelajaran = $request->kode_pelajaran;
            $obj->guru_id = $request->guru_id;
            $obj->aktif = $request->aktif == 'on';
            $obj->keterangan = $request->keterangan ?? '';
            $obj->sekolah_id = $request->user()->id_sekolah;
            $obj->save();
            return response()->json($obj);


        }
        elseif($request->req == 'delete') {
            MataPelajaran::find($request->id)->delete();
        }
    }
}
