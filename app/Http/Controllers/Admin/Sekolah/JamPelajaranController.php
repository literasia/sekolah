<?php

namespace App\Http\Controllers\Admin\Sekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\JamPelajaran;

class JamPelajaranController extends Controller
{

    public function index(Request $request) {
        if($request->req == 'table') {
            return DataTables::of(JamPelajaran::join('gurus', 'gurus.id', 'guru_id')->select('mata_pelajarans.*', 'nama_guru')->get())->addIndexColumn()->toJson();
        }
        if($request->req == 'single') {
            return response()->json(JamPelajaran::findOrFail($request->id));
        }
        $guru = Guru::all();
        return view('admin.pelajaran.mata-pelajaran', compact('guru'));
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
            $obj->save();
            return response()->json($obj);


        }
        elseif($request->req == 'delete') {
            MataPelajaran::find($request->id)->delete();
        }
    }
}
