<?php

namespace App\Http\Controllers\Superadmin\Library;

use Illuminate\Http\Request;
use App\Models\Superadmin\Tipe;
use Yajra\DataTables\DataTables;
use App\Models\Superadmin\Library;
use App\Models\Superadmin\Sekolah;
use App\Http\Controllers\Controller;
use App\Models\Superadmin\Penerbit;
use App\Models\Superadmin\Penulis;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Validator;

class TambahController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            // datatable error
            // $data = Library::with(['penerbit', 'penulis'])->orderBy('name')->get();
            $data = Library::all();
            foreach($data as $d) {
                $penulis = Penulis::find($d['penulis_id']);
                $penerbit = Penerbit::find($d['penerbit_id']);
                $d['penulis'] = $penulis['name'] ?? '-';
                $d['penerbit'] = $penerbit['penerbit'] ?? '-';
                $d['deskripsi'] = $d['deskripsi'] ?? "-";
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $deleteUrl = route('superadmin.library.destroy', $data['id']);
                    $button = '<button type="button" id="'.$data['id'].'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= "<button type='button' class='ml-2 delete btn btn-mini btn-danger shadow-sm' data-url='$deleteUrl' 
                                    data-toggle='modal' data-target='#confirmDeleteModal'><i class='fa fa-trash'></i></button>";
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('superadmin.library.tambah-baru', [
            'sekolahs'  => Sekolah::orderBy('name')->get(),
            'tipes'     => Tipe::orderBy('name')->get(),
            'penulises' => Penulis::orderBy('name')->get(),
            'penerbits' => Penerbit::orderBy('penerbit')->get()
        ]);
    }

    public function store(Request $req) {
        $data = $req->all();
        $validator = Validator::make($data, [
            'name' => ['required'],
            'sekolah_id' => ['nullable', 'exists:sekolahs,id'],
            'tingkat' => ['nullable', 'in:SD,SMP,SMA,SMK,Umum'],
            'kategori_id' => ['nullable', 'exists:tipes,id'],
            'tahun_terbit' => ['nullable', 'numeric'],
            'penulis_id' => ['nullable', 'exists:penulises,id'],
            'penerbit_id' => ['nullable', 'exists:penerbits,id']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        Library::create([
            'name' => $data['name'],
            'sekolah_id' => $data['sekolah_id'],
            'kategori_id' => $data['kategori_id'],
            'tingkat' => $data['tingkat'],
            'tahun_terbit' => $data['tahun_terbit'],
            'penulis_id' => $data['penulis_id'],
            'penerbit_id' => $data['penerbit_id'],
            'link_video' => $data['link_video'],
            'link_audio' => $data['link_audio'],
            'link_ebook' => $data['link_ebook'],
            'deskripsi' => $data['deskripsi'],
        ]);

        return back()->with(CRUDResponse::successCreate("perpustakaan " . $data['name']));
    }
    
    public function destroy($id) {
        $library = Library::findOrFail($id);
        $library->delete();

        return back()->with(CRUDResponse::successDelete("perpustakaan " . $library->name));
    }
}
