<?php

namespace App\Http\Controllers\Superadmin\Library;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Superadmin\Library;
use App\Models\Superadmin\{SubKategori, Sekolah, Tingkat};
use App\Http\Controllers\Controller;
use App\Models\Superadmin\Kategori;
use App\Models\Superadmin\Penerbit;
use App\Models\Superadmin\Penulis;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TambahController extends Controller
{ //
    // private $rules = [
    //     'name' => ['required'],
    //     'sekolah_id' => ['nullable', 'exists:sekolahs,id'],
    //     'tingkat' => ['nullable', 'in:SD,SMP,SMA,SMK,Umum'],
    //     'kategori_id' => ['nullable', 'exists:kategoris,id'],
    //     'tahun_terbit' => ['nullable', 'numeric'],
    //     'penulis_id' => ['nullable', 'exists:penulises,id'],
    //     'penerbit_id' => ['nullable', 'exists:penerbits,id'],
    //     'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000']
    // ];

    public function index(Request $request)
    {

        if ($request->ajax()) {
            // datatable error
            // $data = Library::with(['penerbit', 'penulis'])->orderBy('name')->get();
            $data = Library::latest()->get();
            foreach ($data as $d) {
                $penulis = Penulis::find($d['penulis_id']);
                $penerbit = Penerbit::find($d['penerbit_id']);
                $d['penulis'] = $penulis['name'] ?? '-';
                $d['penerbit'] = $penerbit['penerbit'] ?? '-';
                $d['deskripsi'] = $d['deskripsi'] ?? "-";
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    if (!$data->link_audio == '') {
                        $audio = "<button type='button' class='ml-2 delete btn btn-mini btn-primary shadow-sm'><i class='far fa-file-audio'></i></button>";
                    } else {
                        $audio = '';
                    }

                    if (!$data->link_ebook == '') {
                        $ebook = "<button type='button' class='ml-2 delete btn btn-mini btn-info shadow-sm'><i class='fas fa-book'></i></button>";
                    } else {
                        $ebook = '';
                    }

                    if (!$data->link_video == '') {
                        $video = "<button type='button' class='ml-2 delete btn btn-mini btn-danger shadow-sm'><i class='far fa-file-video'></i></button>";
                    } else {
                        $video = '';
                    }
                    $icon = $audio . $video . $ebook;

                    return $icon;
                })
                ->addColumn('sub_kategori', function($data){
                    if(empty($data->subKategori->title)){
                        return "-";
                    }else{
                        return $data->subKategori->title;
                    }
                })
                ->addColumn('tingkat', function($data){
                    if(empty($data->tingkat->name)){
                        return "-";
                    }else{
                        return $data->tingkat->name;
                    }
                })
                ->escapeColumns('status')
                ->addColumn('action', function ($data) {
                    $deleteUrl = route('superadmin.library.destroy', $data['id']);
                    // $button = '<button type="button" id="'.$data['id'].'" class="edit btn btn-mini btn-info shadow-sm" onclick="editBtnClicked(event);"><i class="fa fa-pencil-alt"></i></button>';
                    // $button = '<a class="edit btn btn-mini btn-info shadow-sm" href=' . route('superadmin.library.edit', $data['id']) . '><i class="fa fa-pencil-alt"></i></a>';
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('superadmin.library.tambah-baru', [
            'sekolahs'  => Sekolah::latest()->get(),
            'kategoris'     => Kategori::get(),
            'sekolahs'  => Sekolah::orderBy('name')->get(),
            'kategoris' => Kategori::orderBy('name')->get(),
            'penulises' => Penulis::orderBy('name')->get(),
            'penerbits' => Penerbit::orderBy('penerbit')->get(),
            'sub_kategoris'     => SubKategori::latest()->get(),
            'tingkats' => Tingkat::get()
        ]);
    }

    public function store(Request $req)
    {
        $rules = [
            'name' => ['required'],
            'sekolah_id' => ['nullable'],
            'tingkat_id' => ['required'],
            'sub_kategori_id' => ['required'],
            'tahun_terbit' => ['required'],
            'penulis_id' => ['required'],
            'penerbit_id' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000']
        ];

        $data = $req->all();
      
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        $data['thumbnail'] = null;
        if ($req->file('thumbnail')) {
            $data['thumbnail'] = $req->file('thumbnail')->store('libraries', 'public');
        }

        Library::create([
            'name' => $data['name'],
            'sekolah_id' => $data['sekolah_id'],
            'sub_kategori_id' => $data['sub_kategori_id'],
            'tingkat_id' => $data['tingkat_id'],
            'tahun_terbit' => $data['tahun_terbit'],
            'penulis_id' => $data['penulis_id'],
            'penerbit_id' => $data['penerbit_id'],
            'link_video' => $data['link_video'],
            'link_audio' => $data['link_audio'],
            'link_ebook' => $data['link_ebook'],
            'deskripsi' => $data['deskripsi'],
            'thumbnail' => $data['thumbnail']
        ]);

        return response()->json(["massage" => "Data berhasil disimpan", "success" => true]);
    }

    public function show($id)
    {
        $library = Library::findOrFail($id);
        return response()
            ->json([                
                'library'   => $library,
            ]);
    }

    public function edit($id)
    {
        $library = Library::findOrFail($id);
        return view('superadmin.library.tambah-baru_edit', [
            'library' => $library,
            'sekolahs'  => Sekolah::orderBy('name')->get(),
            'kategoris' => Kategori::orderBy('name')->get(),
            'penulises' => Penulis::orderBy('name')->get(),
            'penerbits' => Penerbit::orderBy('penerbit')->get(),
            'deskripsis' => Deskripsi::orderBy('name')->get(),
            'sub_kategoris'     => SubKategori::latest()->get(),
            'tingkats' => Tingkat::get()
        ]);
    }

    public function update(Request $req)
    {
        $data = $req->all();

        $rules = [
            'name' => ['required'],
            'sekolah_id' => ['nullable'],
            'tingkat_id' => ['required'],
            'sub_kategori_id' => ['required'],
            'tahun_terbit' => ['required'],
            'penulis_id' => ['required'],
            'penerbit_id' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000']
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        $library = Library::findOrFail($req->hidden_id);
        $data['thumbnail'] = null;
        if ($req->file('thumbnail')) {
            $data['thumbnail'] = $req->file('thumbnail')->store('libraries', 'public');
        }

        $library->update([
            'name' => $data['name'],
            'sekolah_id' => $data['sekolah_id'],
            'tahun_terbit' => $data['tahun_terbit'],
            'penulis_id' => $data['penulis_id'],
            'penerbit_id' => $data['penerbit_id'],
            'link_video' => $data['link_video'],
            'link_audio' => $data['link_audio'],
            'link_ebook' => $data['link_ebook'],
            'deskripsi' => $data['deskripsi'],
            'thumbnail' => $data['thumbnail'] ?? $library->thumbnail,
            'sub_kategori_id' => $data['sub_kategori_id'],
            'tingkat_id' => $data['tingkat_id'],
        ]);

        if ($req->file('thumbnail') && $library->thumbnail && Storage::disk('public')->exists($library->thumbnail)) {
            Storage::disk('public')->delete($library->thumbnail);
        }

        return response()->json(["massage" => "Data berhasil diubah", "success" => true]);
        
    }

    public function destroy($id)
    {
        $library = Library::findOrFail($id);
        $library->delete();
        if ($library->thumbnail && Storage::disk('public')->exists($library->thumbnail)) {
            Storage::disk('public')->delete($library->thumbnail);
        }

        return back()->with(CRUDResponse::successDelete("perpustakaan " . $library->name));
    }
}
