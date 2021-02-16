<?php

namespace App\Http\Controllers\Admin\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;

class JadwalPelajaranController extends Controller
{

    public function index(Request $request) {
        $data = null;

        if($request->req == 'table') {
            $data = JadwalPelajaran::where('tahun_ajaran', $request->tahun_ajaran)
                                   ->where('kelas', $request->kelas)
                                   ->where('semester', $request->semester)
                                   ->orderBy('jam_pelajaran')
                                   ->get();
            
                                   $data = $data->groupBy('hari');
        }
        
        elseif($request->req == 'single') {
            $obj = JadwalPelajaran::findOrFail($request->id);
            return response()->json($obj);
        }

        $jam_pelajaran = [
            ['id' => '-', 'label' => '(07:30 - 08:00)' ],
            ['id' => '1', 'label' => '(08:00 - 08:45)' ],
            ['id' => '2', 'label' => '(08:45 - 09:30)' ],
            ['id' => '3', 'label' => '(09:30 - 10:15)' ],
            ['id' => '-', 'label' => '(10:15 - 10:30)' ],
            ['id' => '4', 'label' => '(10:30 - 11:15)' ],
            ['id' => '5', 'label' => '(11:15 - 12:00)' ],
            ['id' => '-', 'label' => '(12:00 - 12:15)' ],
            ['id' => '6', 'label' => '(12:15 - 13:00)' ],
            ['id' => '7', 'label' => '(13:00 - 13:45)' ],
            ['id' => '-', 'label' => '(13:45 - 14:00)' ],
            ['id' => '8', 'label' => '(14:00 - 14:45)' ],
            ['id' => '9', 'label' => '(14:45 - 15:30)' ],
        ];

        $kelas = ['X', 'XI', 'XII'];

        $tahun_ajaran = ['2019/2020', '2020/2021'];
        
        return view('admin.pelajaran.jadwal-pelajaran', compact('jam_pelajaran', 'kelas', 'tahun_ajaran', 'data'));
    }

    public function write(Request $request) {

        if($request->req == 'write') {
            $obj = JadwalPelajaran::find($request->id);

            if(!$obj) {
                $obj = new JadwalPelajaran();
            }

            $obj->kelas = $request->kelas;
            $obj->mata_pelajaran_id = 1; //$request->mata_pelajaran_id;
            $obj->hari = $request->hari;
            $obj->semester = $request->semester;
            $obj->tahun_ajaran = $request->tahun_ajaran;
            $obj->jam_pelajaran = $request->jam_pelajaran;
            $obj->keterangan = $request->keterangan;
            $obj->save();

            return response()->json($obj);
        }
        elseif($request->req == 'delete') {
            $obj = JadwalPelajaran::findOrfail($request->id);
            return response()->json($obj->delete());
        }
    }
}