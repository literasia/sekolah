<?php

namespace App\Http\Controllers\Admin\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{JadwalPelajaran, JamPelajaran, MataPelajaran, TingkatanKelas, Semester};
use App\Models\Admin\Kelas;
use App\User;
use App\Models\Superadmin\{Sekolah, Addons};

class JadwalPelajaranController extends Controller
{

    public function index(Request $request) {
        $data = null;
        $addons = Addons::where('user_id', auth()->user()->id)->first();
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

        return view('admin.pelajaran.jadwal-pelajaran', compact('kelas_id', 'sekolah', 'semester', 'kelas', 'tahun_ajaran', 'addons', 'data', 'pelajaran'), ['mySekolah' => User::sekolah()]);
    }

    public function getJamPelajaran(Request $request)
    {
        // $jam_pelajarans = JamPelajaran::where([
        //     'sekolah_id'=>auth()->user()->sekolah()->id,
        //     'hari'=>$request->hari
        // ])->orderBy('jam_mulai')->get();
        // $rowCount=0;
        // $html = NULL;
        // foreach($jam_pelajarans->chunk(6) as $key=>$chunk_jp){
        //     $html.='<div class="col-sm-6">';
        //     foreach($chunk_jp as $jp){
        //         $html .= '
        //           <div class="form-check">
        //             <label class="form-check-label">
        //                 <input class="form-check-input" type="checkbox" name="jam_pelajaran[]" value="'.$jp->id.'">
        //                 '.$jp->jam_ke.' '.date("H:i", strtotime($jp->jam_mulai)).' - '.date("H:i", strtotime($jp->jam_selesai)).'
        //             </label>
        //           </div>';
        //     }
        //     $html.='</div>';
        // }
        // echo $html;

        $jam_pelajarans = JamPelajaran::where([
            'sekolah_id'=>auth()->user()->sekolah()->id,
            'hari'=>$request->hari
        ])->orderBy('jam_mulai')->get();
        
        return response()->json($jam_pelajarans);
    }

    public function getJadwalPelajaran(Request $request)
    {
        $kelas = $request->kelas;
        $semester = $request->semester;
        $tahun_ajaran = $request->tahun_ajaran;
    }

    public function write(Request $request) {
        if($request->req == 'write') {
            $jam_pelajaran_ids = $request->jam_pelajaran_id;
            $mata_pelajaran_ids = $request->mata_pelajaran_id;
            
            for ($i=0; $i < count($jam_pelajaran_ids); $i++) { 
                $obj = JadwalPelajaran::find($request->id);
                if(!$obj) {
                    $obj = new JadwalPelajaran();
                }
                $obj->kelas_id = $request->kelas_id;
                $obj->mata_pelajaran_id = $mata_pelajaran_ids[$i];
                $obj->hari = $request->hari;
                $obj->semester = $request->semester;
                $obj->tahun_ajaran = $request->tahun_ajaran;
                $obj->jam_pelajaran = $jam_pelajaran_ids[$i];
                $obj->keterangan = $request->keterangan;
                $obj->save();
            }

            return response()->json($obj);

            // foreach($request->jam_pelajaran as $jam_pelajaran){
            //     $obj = JadwalPelajaran::find($request->id);
            //     if(!$obj) {
            //         $obj = new JadwalPelajaran();
            //     }
            //     $obj->kelas_id = $request->kelas_id;
            //     $obj->mata_pelajaran_id = $request->mata_pelajaran_id;
            //     $obj->hari = $request->hari;
            //     $obj->semester = $request->semester;
            //     $obj->tahun_ajaran = $request->tahun_ajaran;
            //     $obj->jam_pelajaran = $jam_pelajaran;
            //     $obj->keterangan = $request->keterangan;
            //     $obj->save();
            // }
        }
        elseif($request->req == 'delete') {
            $obj = JadwalPelajaran::findOrfail($request->id);
            return response()->json($obj->delete());
        }
    }
}