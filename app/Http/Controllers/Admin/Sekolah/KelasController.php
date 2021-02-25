<?php

namespace App\Http\Controllers\Admin\Sekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Kelas;
use App\Models\TingkatanKelas;
use App\Models\Pegawai;
use App\Models\Admin\Jurusan;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DataTables;
use Exeption;


class KelasController extends Controller
{
    //read
    public function index(Request $request) {
        if ($request->ajax()) {
            // $data = Guru::latest()->get();
            $data = Kelas::join('pegawais', 'kelas.pegawai_id', 'pegawais.id')
                ->join('jurusans', 'kelas.jurusan_id', 'jurusans.id')
                ->where('kelas.user_id', Auth::id())
                ->get(['kelas.*', 'pegawais.name AS wali_kelas', 'jurusans.name AS jurusan']);
            // $data = Kelas::all();
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
        $kelas = Kelas::join('pegawais', 'kelas.pegawai_id', 'pegawais.id')
            ->join('jurusans', 'kelas.jurusan_id', 'jurusans.id')
            ->where('kelas.user_id', Auth::id())
            ->get(['kelas.*', 'pegawais.name AS guru', 'jurusans.name AS jurusan']);
        $pegawai = Pegawai::join('gurus', 'pegawais.id', 'gurus.pegawai_id')
            ->where('gurus.user_id', Auth::id())
            ->get();
        $tingkat = TingkatanKelas::where('user_id', Auth::id())->latest()->get();
        $jurusan = Jurusan::where('user_id', Auth::id())->latest()->get();

        return view('admin.sekolah.kelas',['tingkat' => $tingkat, 'jurusan' => $jurusan, 'pegawai' => $pegawai, 'mySekolah' => User::sekolah()]);
    }

    public function store(Request $request)
    {
        // validasi
        $rules = [
            'name'  => 'required|max:100',
            'tingkat'  => 'required|max:100',
            'jurusan'  => 'required|max:100',
            'kapasitas' => 'nullable',
            'keterangan' => 'nullable',
        ];

        $message = [
            'name.required' => 'Kolom ini tidak boleh kosong',
            'tingkat.required' => 'Kolom ini tidak boleh kosong',
            'jurusan.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Kelas::create([
            'name' => $request->input('name'),
            'tingkatan_kelas_id' => $request->input('tingkat'),
            'pegawai_id' => $request->input('wali_kelas'),
            'jurusan_id' => $request->input('jurusan'),
            'kapasitas' => $request->input('kapasitas'),
            'keterangan' => $request->input('keterangan'),
            'user_id' => Auth::id()
        ]);

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $kelas = Kelas::find($id);

        return response()
            ->json([
                'kelas' => $kelas,
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'name'  => 'required|max:100',
            'tingkat'  => 'required|max:100',
            'jurusan'  => 'required|max:100',
            'kapasitas' => 'nullable',
            'keterangan' => 'nullable',
        ];

        $message = [
            'name.required' => 'Kolom ini tidak boleh kosong',
            'tingkat.required' => 'Kolom ini tidak boleh kosong',
            'jurusan.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Kelas::whereId($request->hidden_id)->update([
            'name' => $request->input('name'),
            'tingkatan_kelas_id' => $request->input('tingkat'),
            'pegawai_id' => $request->input('wali_kelas'),
            'jurusan_id' => $request->input('jurusan'),
            'kapasitas' => $request->input('kapasitas'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return response()
            ->json([
                'success'   => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $pegawai = Kelas::find($id);
        $pegawai->delete();
    }
}
