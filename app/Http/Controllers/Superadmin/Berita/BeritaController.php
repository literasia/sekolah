<?php

namespace App\Http\Controllers\Superadmin\Berita;


use Illuminate\Http\Request;
use App\Models\Superadmin\KategoriBerita;
use App\Models\Superadmin\Berita;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Utils\CRUDResponse;
use Yajra\DataTables\DataTables;

class BeritaController extends Controller
{ //
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Berita::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('thumbnail', function ($data) {
                    $btnlink = '<a target="_blank" href="'.Storage::url($data->thumbnail).'" class="badge badge-warning">Lihat Foto</a>';
                    return $btnlink;
                })
                ->rawColumns(['action', 'thumbnail'])
                ->addIndexColumn()
                ->make(true);
        }
        $kategori = KategoriBerita::all();
        return view('superadmin.berita.berita', ['kategori' => $kategori]);
    }

    public function edit($id) {
        $berita = Berita::findOrFail($id);

        return response()->json([
            'id' => $berita->id,
            'judul' => $berita->name,
            'kategori' => $berita->kategori,
            'isi' => $berita->isi,
            'tanggal_rilis' => $berita->tanggal_rilis,
            'thumbnail' => $berita->thumbnail
        ]);
    }

    public function store(Request $req) {
        $rules = [
            'judul' => ['required'],
            'kategori' => ['required'],
            'isi' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000']
        ];

        $data = $req->all();
        $validator = Validator::make($data, $rules);

        // Validation rules
        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        $data['thumbnail'] = null;
        if ($req->file('thumbnail')) {
            $data['thumbnail'] = $req->file('thumbnail')->store('berita', 'public');
        }

        Berita::create([
            'name' => $data['judul'],
            'kategori' => $data['kategori'],
            'tanggal_rilis' => $data['tanggal_rilis'],
            'isi' => $data['isi'],
            'thumbnail' => $data['thumbnail']
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
        ]);

    }

    public function update(Request $req) {
        $rules = [
            'judul' => ['required'],
            'kategori' => ['required'],
            'isi' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000']
        ];

        $data = $req->all();
        $validator = Validator::make($data, $rules);

        // Validation rules
        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        $berita = Berita::findOrFail($data['hidden_id']);
        $data['thumbnail'] = null;
        if ($req->file('thumbnail')) {
            $data['thumbnail'] = $req->file('thumbnail')->store('berita', 'public');
        }

        $berita->update([
            'name' => $data['judul'],
            'kategori' => $data['kategori'],
            'tanggal_rilis' => $data['tanggal_rilis'],
            'isi' => $data['isi'],
            'thumbnail' => $data['thumbnail'] ?? $berita->thumbnail
        ]);

        if ($req->file('thumbnail') && $berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        return response()
        ->json([
            'success' => 'Data berhasil diubah.',
    ]);
    }

    public function destroy($id) {
        $berita = Berita::find($id);
        $berita->delete();
        if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        return response()
        ->json([
            'success' => '👍 Data berhasil dihapus!',
        ]);
    }


}
