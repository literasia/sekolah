<?php

namespace App\Http\Controllers\Admin\Fungsionaris;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Guru;
use DataTables;
use App\Models\StatusGuru;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    //read
    public function index(Request $request) {
        if ($request->ajax()) {
            // $data = Guru::latest()->get();
            $data = Guru::join('pegawais', 'gurus.pegawai_id', 'pegawais.id')
                ->join('status_gurus', 'gurus.status_guru_id', 'status_gurus.id')
                // ->first(['gurus.*', 'pegawais.name AS nama_pegawai', 'status_gurus.name AS nama_status'])
                ->get(['gurus.*', 'pegawais.name AS nama_pegawai', 'status_gurus.name AS nama_status']);
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" data-id="' . $data->id . '" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $pegawai = Pegawai::where('user_id', Auth::id())->latest()->get();
        $status = StatusGuru::where('user_id', Auth::id())->latest()->get();

        return view('admin.fungsionaris.guru',['pegawai' => $pegawai, 'status' => $status, 'mySekolah' => User::sekolah()]);
    }

    public function write(Request $request) {
        if($request->req == 'write') {

            $this->validate($request, [
                'pegawai_id' => "required",
                // isi validasi
            ]);

            $obj = Guru::find($request->id);

            if(!$obj) {
                $obj = new Guru();
            }

            $obj->user_id = Auth::id();
            $obj->pegawai_id = $request->pegawai_id;
            $obj->status_guru_id = $request->status_guru_id;
            $obj->keterangan = $request->keterangan;
            $obj->status = $request->status;
            $obj->save();

            return response()->json(true);
        }

        elseif($request->req == 'delete') {
            $obj = Guru::find($request->id);
            $obj->delete();
            return response()->json(true);
        }
    }
}
