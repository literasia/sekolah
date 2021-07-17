<?php

namespace App\Http\Controllers\Guru\PesertaDidik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, Siswa};
use App\Models\Admin\{SuratPeringatan, Kelas};
use App\User;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // get guru yang sedang login
            $guru = Guru::where('user_id', auth()->user()->id)->first();
            // get data kelas yang dimiliki guru
            $kelas = Kelas::where('pegawai_id', $guru->pegawai->id)->get();
            
            // get siswa 
            $siswa = Siswa::whereHas('kelas', function($query) use($guru){
                $query->where('pegawai_id', $guru->pegawai->id);
            })->get();

            $poin_sp = SuratPeringatan::where('sekolah_id', auth()->user()->id_sekolah)->get();

            $data = [];

            $i = 0;
            foreach ($siswa as $data_siswa) {   
                $data[] = $data_siswa;
                foreach ($poin_sp as $psp) {
                    if ($data_siswa['poin'] <= $psp['poin']) {
                        $data[$i]['poin_sp'] = $data_siswa['poin']."/".$psp['poin'];
                    }
                }   

                $i++;
            }
          
            return DataTables::of($data)
                ->addColumn('kelas', function($data){
                    if(!empty($data->kelas->name)){
                        return $data->kelas->name;
                    }    

                    return "-";
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('guru.pesertadidik.siswa')->with('mySekolah', User::sekolah());
    }
}
