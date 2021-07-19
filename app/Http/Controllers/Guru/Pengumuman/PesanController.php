<?php

namespace App\Http\Controllers\Guru\Pengumuman;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\Addons;
use Illuminate\Http\Request;
use App\Models\Admin\Pesan;
use Yajra\DataTables\DataTables;
use App\Models\Guru;
use App\User;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pesan = Pesan::where('user_id', auth()->user()->id)->get();

        // dd($pesan);
        if ($request->ajax()) {
            return DataTables::of($pesan)
                ->addColumn('action', function ($pesan) {
                    $button = '<button type="button" id="' . $pesan->id . '" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $pesan->id . '" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('guru.pengumuman.pesan', ['pesan' => $pesan, 'mySekolah' => User::sekolah()]);
    }

    public function store(Request $request)
    {
        // / validasi
        $rules = [
            'judul'  => 'required|max:100',
            'message' => 'required',
        ];

        $message = [
            'judul.required' => 'Kolom ini tidak boleh kosong',
            'message.required' => 'Kolom ini tidak boleh kosong',
        ];

        $notifikasi = "";
        if ($request->input('notifikasi') == 'Yes') {
            $notifikasi = 'Yes';
        } else {
            $notifikasi = 'No';
        }

        $dashboard = "";
        if ($request->input('dashboard') == 'Yes') {
            $dashboard = 'Yes';
        } else {
            $dashboard = 'No';
        }

        $start = "";
        if ($request->input('message_time') == 'Permanen') {
            $start = date("Y-m-d");
        } else {
            $start = $request->input('start_date');
        }

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Pesan::create([
            'judul' => $request->input('judul'),
            'notifikasi' => $notifikasi,
            'dashboard' => $dashboard,
            'message_time' => $request->input('message_time'),
            'start_date' => $start,
            'end_date' => $request->input('end_date'),
            'message' => $request->input('message'),
            'status' => 'Aktif',
            'user_id' => Auth::id()
        ]);

        return response()
        ->json([
            'success' => 'Data Added.',
        ]);
    }

    public function edit($id)
    {
        $pesan = Pesan::findOrFail($id);

        return response()
            ->json([
                'kelas' => $kelas,
            ]);
    }

   
    public function update(Request $request)
    {
        // validasi
        $rules = [
            'judul'  => 'required|max:100',
            'message' => 'required',
        ];

        $message = [
            'judul.required' => 'Kolom ini tidak boleh kosong',
            'message.required' => 'Kolom ini tidak boleh kosong',
        ];

        $notifikasi = "";
        if ($req->input('notifikasi') == 'Yes') {
            $notifikasi = 'Yes';
        } else {
            $notifikasi = 'No';
        }

        $dashboard = "";
        if ($req->input('dashboard') == 'Yes') {
            $dashboard = 'Yes';
        } else {
            $dashboard = 'No';
        }

        $start = "";
        if ($req->input('message_time') == 'Permanen') {
            $start = date("Y-m-d");
        } else {
            $start = $req->input('start_date');
        }

        $validator = Validator::make($req->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }
        $update = Pesan::where('id', $req->hidden_id)->update([
            'judul' => $req->input('judul'),
            'notifikasi' => $notifikasi,
            'dashboard' => $dashboard,
            'message_time' => $req->input('message_time'),
            'start_date' => $start,
            'end_date' => $req->input('end_date'),
            'message' => $req->input('message'),
            'status' => 'Aktif',
        ]);

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);

        $pesan->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
