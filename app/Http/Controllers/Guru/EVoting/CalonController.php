<?php

namespace App\Http\Controllers\Guru\EVoting;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Calon;
use App\Models\Siswa;
use App\User;
use Illuminate\Support\Facades\Auth;

class CalonController extends Controller
{
    public function index(Request $request) {
        $namaSiswa = Siswa::join('kelas', 'siswas.kelas_id', 'kelas.id')
            ->where('kelas.user_id', Auth::id())
            ->get('siswas.*');
        if ($request->ajax()) {
            $data = Calon::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    // $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
                    $button = '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        // return($namaSiswa);
        return view('guru.e-voting.calon', ['namaSiswa' => $namaSiswa, 'mySekolah' => User::sekolah()]);
    }

    public function store(Request $request) {
        $data = $request->all();

        // validasi
        $rules = [
            'nama_calon'  => 'required|max:50',
        ];

        $message = [
            'nama_calon.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = Calon::create([
            'name'  => $request->input('nama_calon'),
        ]);

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $calon_id = Calon::find($id);

        return response()
            ->json([
                'calon_id'  => $calon_id
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'calon_id'  => 'required|max:50',
        ];

        $message = [
            'calon_id.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = Calon::whereId($request->input('hidden_id'))->update([
            'name'  => $request->input('nama_calon')
        ]);

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $tingkat = Calon::find($id);
        $tingkat->delete();
    }

}
