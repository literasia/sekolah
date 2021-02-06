<?php

namespace App\Http\Controllers\Admin\Fungsionaris;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Pegawai;
use App\Utils\CRUDResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    private const AGAMA_RULE = "Islam,Budha,Kristen Protestan,Hindu,Kristen Katolik,Konghuchu";

    public function index() {
        $pegawais = Pegawai::all();
        return view('admin.fungsionaris.pegawai', ['pegawais' => $pegawais]);
    }

    public function store(Request $req) {
        $data = $req->all();
        $validator = Validator::make($data, [
            'tanggal_lahir' => ['nullable', 'date'],
            'jk' => ['nullable', 'in:Laki-Laki,Perempuan'],
            'agama' => ['nullable', 'in:' . PegawaiController::AGAMA_RULE],
            'is_menikah' => ['nullable', 'boolean'],
            'tanggal_mulai' => ['nullable', 'date'],
            'bagian' => ['in:Guru/Tenaga Pendidik,Teknisi,Laboran,Tenaga Kependidikan'],
            'semester' => ['nullable', 'in:Genap,Ganjil'],
            'jenjang' => ['nullable', 'in:SD,SMP,SMK,SMA']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all())->withInput();
        }

        $validator = Validator::make($data, [
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'email' => ['nullable', 'unique:users']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all())->withInput();
        }

        $exception = DB::transaction(function () use ($data) {
            $auth = auth()->user();

            DB::beginTransaction();
            try {
                $userId = User::create([
                    'id_sekolah' => $auth['id_sekolah'],
                    'name' => $data['nama_pegawai'],
                    'username' => $data['username'],
                    'nis' => $data['nip'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ])->id;

                $data['tanggal_lahir'] = Carbon::parse($data['tanggal_lahir'])->format('Y-m-d');
                $data['tanggal_mulai'] = Carbon::parse($data['tanggal_mulai'])->format('Y-m-d');
                Pegawai::create([
                    'user_id' => $userId,
                    'name' => $data['nama_pegawai'],
                    'nip' => $data['nip'],
                    'nik' => $data['nik'],
                    'gelar_depan' => $data['gelar_depan'],
                    'gelar_belakang' => $data['gelar_belakang'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tanggal_lahir' => $data['tanggal_lahir'],
                    'jk' => $data['jk'],
                    'agama' => $data['agama'],
                    'is_menikah' => $data['is_menikah'],
                    'alamat_tinggal' => $data['alamat_tinggal'],
                    'provinsi' => $data['provinsi'],
                    'kabupaten' => $data['kabupaten'],
                    'kecamatan' => $data['kecamatan'],
                    'dusun' => $data['dusun'],
                    'rt' => $data['rt'],
                    'rw' => $data['rw'],
                    'kode_pos' => $data['kode_pos'],
                    'no_telepon_rumah' => $data['no_telepon_rumah'],
                    'no_telepon' => $data['no_telepon'],
                    'tanggal_mulai' => $data['tanggal_mulai'],
                    'bagian' => $data['bagian'],
                    'tahun_ajaran' => $data['tahun_ajaran'],
                    'semester' => $data['semester'],
                    'jenjang' => $data['jenjang'],
                    'foto' => $data['foto']
                ]);

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
                return $e->getMessage();
            }
        });

        if ($exception) {
            return redirect()->back()->withErrors($exception)->withInput();
        }

        return redirect()->back()->with(CRUDResponse::successCreate("pegawai"));
    }
    
    public function destroy($id) {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return redirect()->back()->with(CRUDResponse::successDelete("pegawai"));
    }
}
