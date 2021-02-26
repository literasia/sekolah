<?php

namespace App\Http\Controllers\Superadmin\Berita;


use Illuminate\Http\Request;
use App\Models\Superadmin\KategoriBerita;
use App\Models\Superadmin\Berita;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class BeritaController extends Controller
{

    private $rules = [
        'judul' => ['required'],
        'kategori' => ['required'],
        'isi' => ['required'],
        'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000']
    ];

    public function index(Request $request){
        $data = Berita::latest()->get();
        $no = 1;
        // $i = 0;
        // foreach ($data as $berita) {
        //     $data[$i]['thumbnail'] = '<a target="_blank" href="'.Storage::url($berita->thumbnail).'">Lihat Foto</a>';
        // }
    	// if ($request->ajax()) {
     //        $data = Berita::latest()->get();
     //        $i = 0;
     //        foreach ($data as $berita) {
     //            $data[$i]['thumbnail'] = '<a target="_blank" href="'.Storage::url($berita->thumbnail).'">Lihat Foto</a>';
     //        }
     //        return DataTables::of($data)
     //            ->addColumn('action', function ($data) {
     //                $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm">Edit</button>';
     //                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
     //                return $button;
     //            })
     //            ->rawColumns(['action'])
     //            ->rawColumns(['thumbnail'])
     //            ->addIndexColumn()
     //            ->make(true);
     //    }
        $katbe = KategoriBerita::all();
    	return view('superadmin.berita.berita', ['no'=>$no, 'katbe' => $katbe, 'data' =>$data]);
    }

    public function store(Request $req) {
        // dd($req->thumbnail);

        $data = $req->all();
        $validator = Validator::make($data, $this->rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        $data['thumbnail'] = null;
        if ($req->file('thumbnail')) {
            $data['thumbnail'] = $req->file('thumbnail')->store('berita', 'public');
        }
        
        Berita::create([
            'name' => $data['judul'],
            'kategori' => $data['kategori'],
            'isi' => $data['isi'],
            'thumbnail' => $data['thumbnail']
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
        ]);

    }

}
