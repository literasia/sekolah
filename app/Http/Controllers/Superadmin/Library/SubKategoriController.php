<?php

namespace App\Http\Controllers\Superadmin\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Superadmin\Kategori;
use App\Models\Superadmin\SubKategori;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Utils\CRUDResponse;


class SubKategoriController extends Controller
{
    private $rules = [
        // 'kategori' => ['required'],
        'title' => ['required']
    ];

    public function index(Request $request)
    {   
        $kategori = Kategori::all();
        $subkategoris  = SubKategori::all();
        if ($request->ajax()) {
            // datatable error
            // $data = Library::with(['penerbit', 'penulis'])->orderBy('name')->get();
            $data = SubKategori::all();
            foreach ($data as $d) {
                $kategori = Kategori::find($d['id']);
                $d['id'] = $kategori['id'] ?? '-';
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    if (!$data->title == '') {
                        $title = "<button type='button' class='ml-2 delete btn btn-mini btn-primary shadow-sm'><i class='far fa-file-audio'></i></button>";
                    } else {
                        $title = '';
                    }   

                    return $title;
                })
                ->escapeColumns('status')
                ->addColumn('action', function ($data) {
                    $deleteUrl = route('superadmin.library.sub-kategori.destroy', $data['id']);
                    // $button = '<button type="button" id="'.$data['id'].'" class="edit btn btn-mini btn-info shadow-sm" onclick="editBtnClicked(event);"><i class="fa fa-pencil-alt"></i></button>';
                    $button = '<a class="edit btn btn-mini btn-info shadow-sm" href=' . route('superadmin.library.sub-kategori.edit', $data['id']) . '><i class="fa fa-pencil-alt"></i></a>';
                    $button .= "<button type='button' class='ml-2 delete btn btn-mini btn-danger shadow-sm' data-url='$deleteUrl' 
                                    data-toggle='modal' data-target='#confirmDeleteModal'><i class='fa fa-trash'></i></button>";
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('superadmin.library.sub-kategori.tambah-baru', [
            'subkategoris'  => SubKategori::latest()->get(),
            'kategoris'     => Kategori::latest()->get(),
            'subkategoris'  => SubKategori::orderBy('title')->get()
        ]);
    }

    public function store(Request $req)
    {
        $kategori = Kategori::all();
        $data = $req->all();
        $validator = Validator::make($data, $this->rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        SubKategori::create([
            'title' => $data['title'],
            'kategori_id' => $data['kategori_id']
        ]);

        return back()->with(CRUDResponse::successCreate("sub-kategori " . $data['title']));
        // return redirect()->route('superadmin.library.index')->with(CRUDResponse::successCreate("title " . $subkategori->title));
    }

    public function edit($id)
    {
        $subkategori = SubKategori::findOrFail($id);
        return view('superadmin.library.subkategori_edit', [
            'library' => $library,
            'subkategoris'  => SubKategoris::orderBy('title')->get(),
            'kategoris' => Kategori::orderBy('name')->get()
        ]);
    }

    public function update($id, Request $req)
    {
        $data = $req->all();

        $validator = Validator::make($data, $this->rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        $subkategori = SubKategori::findOrFail($id);

        Library::whereId($id)->update([
            'title' => $data['title']
        ]);

        return redirect()->route('superadmin.library.index')->with(CRUDResponse::successUpdate("title " . $subkategori->title));
    }

    public function destroy($id)
    {
        $subkategori = SubKategori::findOrFail($id);
        $subkategori->delete();

        return back()->with(CRUDResponse::successDelete("title " . $subkategori->title));
    }
}
