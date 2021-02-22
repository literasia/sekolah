<?php

namespace App\Http\Controllers\Superadmin\Library;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\Kategori;
use App\Utils\CRUDResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
    }

    public function store(Request $req) {
        $data = $req->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'min:3']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all())->with(CRUDResponse::errorInputNotif("kategori"));
        }

        Kategori::create(['name' => $data['name']]);

        return back()->with(CRUDResponse::successCreateNotif("kategori " . $data['name']));
    }

    public function show($id) {
        $kategori = Kategori::find($id);
        return response()->json(['kategori' => $kategori]);
    }

    public function update($id, Request $req) {
        $data = $req->all();
        $kategori = Kategori::findOrFail($id);

        $validator = Validator::make($data, [
            'name' => ['required', 'min:3']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all())->with(CRUDResponse::errorInputNotif("kategori"));
        }

        $kategori->name = $data['name'];
        $kategori->save();

        return back()->with(CRUDResponse::successUpdateNotif("kategori " . $data['name']));
    }

    public function destroy($id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return back()->with(CRUDResponse::successDeleteNotif("kategori " . $kategori->name));
    }
}
