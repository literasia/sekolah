<?php

namespace App\Http\Controllers\Superadmin\Library;

use Validator;
use Illuminate\Http\Request;
use App\Models\Superadmin\Tipe;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index() {
        return view('superadmin.library.setting', [
            'tipes'     => Tipe::latest()->get(),
        ]);
    }

    public function tipeStore(Request $request) {
        // validasi
        $rules = [
            'tipe'    => 'required|max:100',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'tipe.required'  => 'kolom tidak boleh kososng'
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Tipe::create([
            'name'   => $request->input('tipe'),
        ]);

        return response()
            ->json([
                'success'   => '👍 '.$request->input('tipe').' berhasil ditambahkan',
            ]);
    }
}
