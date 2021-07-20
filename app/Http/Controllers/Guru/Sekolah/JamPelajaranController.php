<?php

namespace App\Http\Controllers\Guru\Sekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\JamPelajaran;

class JamPelajaranController extends Controller
{
    public function index(Request $request)
    {
    
        $kelas_id = $request->kelas_id;

        if($request->req == 'single') {
            return response()->json(JamPelajaran::findOrFail($request->id));
        }

        $data = JamPelajaran::where('sekolah_id', $request->user()->id_sekolah)
                            ->orderBy('jam_mulai')
                            ->get();

        $data = $data->groupBy('hari');
        
        return view('guru.sekolah.jam-pelajaran', compact('data'), ['mySekolah' => User::sekolah()]);
    }

    public function write(Request $request) {
        if($request->req == 'write') {
            
            $jam_ke_ids = $request->jam_ke;
            $jam_mulai_ids = $request->jam_mulai;
            $jam_selesai_ids = $request->jam_selesai;
            
            for ($i=0; $i < count($jam_ke_ids); $i++) {
                $obj = JamPelajaran::find($jam_ke_ids[$i]);
                
                if(!$obj){
                    $obj = new JamPelajaran();
                }
                
                $obj->sekolah_id = $request->user()->id_sekolah;
                $obj->hari = $request->hari;
                $obj->jam_ke = $jam_ke_ids[$i];
                $obj->jam_mulai = $jam_mulai_ids[$i];
                $obj->jam_selesai = $jam_selesai_ids[$i];
                $obj->istirahat = $request->istirahat ?? false;
                $obj->editor_id = $request->user()->id;
                
                $obj->save();
            }
            
            return response()->json($obj);

        }
        elseif($request->req == 'delete') {
            $obj = JamPelajaran::findOrfail($request->id);
            return response()->json($obj->delete());
            // JamPelajaran::find($request->id)->delete();
        }
    }
}