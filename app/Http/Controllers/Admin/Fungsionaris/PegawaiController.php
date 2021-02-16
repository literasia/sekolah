<?php

namespace App\Http\Controllers\Admin\Fungsionaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use DataTables;

class PegawaiController extends Controller
{
    public function index(Request $request) {
        if($request->req == 'table') {
            return DataTables::of(Pegawai::get())->toJson();
        }

        elseif($request->req == 'single') {
            return response()->json(Pegawai::find($request->id));
        }

        return view('admin.fungsionaris.pegawai');
    }

    public function write(Request $request) {
        if($request->req == 'write') {

            $this->validate($request, [
                'nama_pegawai' => "required",
                // isi validasi
            ]);

            $obj = Pegawai::find($request->id);

            if(!$obj) {
                $obj = new Pegawai();
            }

            $obj->nama_pegawai = $request->nama_pegawai;
            $obj->nip = $request->nip;
            $obj->nik = $request->nik;
            $obj->gelar_depan = $request->gelar_depan;
            $obj->gelar_belakang = $request->gelar_belakang;
            $obj->tempat_lahir = $request->tempat_lahir;
            $obj->tanggal_lahir = $request->tanggal_lahir;
            $obj->jenis_kelamin = $request->jenis_kelamin;
            $obj->agama = $request->agama;
            $obj->status = $request->status;
            $obj->alamat_tinggal = $request->alamat_tinggal;
            $obj->provinsi = $request->provinsi;
            $obj->kabupaten = $request->kabupaten;
            $obj->kecamatan = $request->kecamatan;
            $obj->dusun = $request->dusun;
            $obj->rt = $request->rt;
            $obj->rw = $request->rw;
            $obj->kode_pos = $request->kode_pos;
            $obj->no_telepon_rumah = $request->no_telepon_rumah;
            $obj->no_telepon = $request->no_telepon;
            $obj->email = $request->email;
            $obj->username = $request->username;
            $obj->password = $request->password;
            $obj->tanggal_mulai = $request->tanggal_mulai;
            $obj->bagian_pegawai = $request->bagian_pegawai;
            $obj->tahun_ajaran = $request->tahun_ajaran;
            $obj->semester = $request->semester;
            $obj->jenjang = $request->jenjang;
            $obj->save();

            return response()->json(true);
        }

        elseif($request->req == 'delete') {
            $obj = Pegawai::find($request->id);
            $obj->delete();
            return response()->json(true);
        }
    }
}
