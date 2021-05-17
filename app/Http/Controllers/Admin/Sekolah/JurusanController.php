<?php

namespace App\Http\Controllers\Admin\Sekolah;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Jurusan;
use Yajra\DataTables\DataTables;
use App\User;
use Illuminate\Support\Facades\Auth;
// use Yajra\DataTables\Facades\DataTables;
use App\Models\Superadmin\Addons;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        if ($request->ajax())
        {
            $data = Jurusan::where('user_id', Auth::id())->latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.sekolah.jurusan', ['mySekolah' => User::sekolah(), 'addons' => $addons]);
    }

    public function store(Request $request)
    {
        // validasi
        $rules = [
            'kode'  => 'required|max:20',
            'name'  => 'required|max:100',
        ];

        $message = [
            'kode.required' => 'Kolom ini tidak boleh kosong',
            'name.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Jurusan::create([
            'kode'  => $request->input('kode'),
            'name'  => $request->input('name'),
            'user_id' => Auth::id()
        ]);

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $jurusan = Jurusan::find($id);

        return response()
            ->json([
                'jurusan'   => $jurusan,
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'kode'  => 'required|max:20',
            'name'  => 'required|max:100',
        ];

        $message = [
            'kode.required' => 'Kolom ini tidak boleh kosong',
            'name.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Jurusan::whereId($request->hidden_id)->update([
            'kode'  => $request->input('kode'),
            'name'  => $request->input('name'),
        ]);

        return response()
            ->json([
                'success'   => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $pegawai = Jurusan::find($id);
        $pegawai->delete();
    }
}
