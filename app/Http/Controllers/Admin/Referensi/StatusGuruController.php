<?php

namespace App\Http\Controllers\Admin\Referensi;

use Validator;
use App\Models\StatusGuru;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class StatusGuruController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        if ($request->ajax()) {
            $data = StatusGuru::where('user_id', auth()->id())->get();
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

        return view('admin.referensi.status-guru', ['mySekolah' => User::sekolah(), 'addons' => $addons]);
    }

    public function store(Request $request) {
        // validasi
        $rules = [
            'status_guru'  => 'required|max:100',
        ];

        $message = [
            'status_guru.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = StatusGuru::create([
            'name'  => $request->input('status_guru'),
            'user_id' => Auth::id()
        ]);

        return response()
            ->json([
                'success' => 'Data Added.',
            ]);
    }

    public function edit($id) {
        $status = StatusGuru::find($id);

        return response()
            ->json([
                'status'  => $status
            ]);
    }

    public function update(Request $request) {
        // validasi
        $rules = [
            'status_guru'  => 'required|max:100',
        ];

        $message = [
            'status_guru.required' => 'Kolom ini gaboleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        $status = StatusGuru::whereId($request->input('hidden_id'))->update([
            'name'  => $request->input('status_guru'),
        ]);

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id) {
        $status = StatusGuru::find($id);
        $status->delete();
    }
}
