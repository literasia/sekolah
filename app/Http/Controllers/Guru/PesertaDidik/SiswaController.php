<?php

namespace App\Http\Controllers\Guru\PesertaDidik;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\SiswaOrangTua;
use App\Models\SiswaWali;
use App\Models\TingkatanKelas;
use App\Models\Admin\Kelas;
use App\Models\Admin\SuratPeringatan;
use App\Models\Superadmin\Provinsi;
use App\User;
use App\Utils\CRUDResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    private const AGAMA_RULE = "Islam,Budha,Kristen Protestan,Hindu,Kristen Katolik,Konghuchu";
    private const KEWARGANEGARAAN_RULE = "WNI,WNA";
    private const PENDIDIKAN_RULE = "SD/Sederajat,SMP/MTs/Sederajat,SMA/MA/Sederajat,D1/D2/D3,S1,S2,S3";
    private $siswaRules = [
        'nama_lengkap' => 'required',
        'kelas' => ['required', 'exists:kelas,id'],
        'jk' => ['nullable', 'in:Laki-Laki,Perempuan'],
        'agama' => ['nullable', 'in:' . SiswaController::AGAMA_RULE],
        'suku' => ['nullable', 'in:Melayu,Aceh,Batak,Karo,Mandailing,Simalungun,Pak-Pak,Nias,Angkola,Jawa'],
        'golongan_darah' => ['nullable', 'in:A,B,AB,O'],
        'tanggal_lahir' => ['nullable', 'date'],
        'tanggal_masuk' => ['nullable', 'date'],
        'berat_badan' => ['nullable', 'numeric'],
        'tinggi_badan' =>  ['nullable', 'numeric'],
        'jarak_rumah_sekolah' =>  ['nullable', 'numeric'],
        'foto' => ['nullable', 'mimes:jpeg,jpg,png', 'max:2000']
    ];

    private $siswaOrtuRules = [
        'anak_ke' =>  ['nullable', 'numeric'],
        'jumlah_saudara' =>  ['nullable', 'numeric'],
        'tanggal_lahir_ayah' => ['nullable', 'date'],
        'agama_ayah' => ['nullable', 'in:' . SiswaController::AGAMA_RULE],
        'kewarganegaraan_ayah' => ['nullable', 'in:' . SiswaController::KEWARGANEGARAAN_RULE],
        'pendidikan_ayah' => ['nullable', 'in:' . SiswaController::PENDIDIKAN_RULE],
        'agama_ibu' => ['nullable', 'in:' . SiswaController::AGAMA_RULE],
        'kewarganegaraan_ibu' => ['nullable', 'in:' . SiswaController::KEWARGANEGARAAN_RULE],
        'pendidikan_ibu' => ['nullable', 'in:' . SiswaController::PENDIDIKAN_RULE],
        'tanggal_lahir_ibu' => ['nullable', 'date']
    ];

    private $siswaWaliRules = [
        'tanggal_lahir_wali' => ['nullable', 'date'],
        'agama_wali' => ['nullable', 'in:' . SiswaController::AGAMA_RULE],
        'kewarganegaraan_wali' => ['nullable', 'in:' . SiswaController::KEWARGANEGARAAN_RULE],
        'pendidikan_wali' => ['nullable', 'in:' . SiswaController::PENDIDIKAN_RULE],
    ];

    private $siswaLoginRules = [
        'username' => ['required', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:6']
    ];

    public function index() {
        $sekolahId = auth()->user()->id_sekolah;
        $userId = auth()->user()->id;
        $kelases = Kelas::where('user_id', auth()->user()->id)->get();
        // $users = User::has('siswa')
        //         ->where([
        //             ['id_sekolah', $sekolahId],
        //             ['role_id', 3]
        //         ])->whereNotNull('siswa_id')
        //         ->get();
        $fetch_siswa = Siswa::whereIn('id', function($query){
            $query->select('siswa_id')->from('users')->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        $provinsis = Provinsi::all();
        $poin_sp = SuratPeringatan::where('sekolah_id', auth()->user()->id_sekolah)->get();
        
        $siswas = [];

        $i = 0;
        foreach ($fetch_siswa as $siswa) {   
            $siswas[] = $siswa;

            foreach ($poin_sp as $psp) {
                if ($siswa['poin'] <= $psp['poin']) {
                    $siswas[$i]['poin_sp'] = $siswa['poin']."/".$psp['poin'];
                }
            }
            
            $i++;
        }

        return view('guru.pesertadidik.siswa', [
            'siswas' => $siswas,
            'kelases' => $kelases,
            'mySekolah' => User::sekolah(),
            'provinsis'=>$provinsis,
        ]);
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
