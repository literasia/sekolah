<?php

namespace App\Http\Controllers\Admin\Sambutan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Storage;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Admin\SambutanKepsek;

class SambutanController extends Controller
{

    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $sambutan_kepsek = SambutanKepsek::where('sekolah_id', auth()->user()->id_sekolah)->get();

        
        return view('admin.sambutan.sambutan')   
                                    ->with('addons', $addons)
                                    ->with('mySekolah', User::sekolah())
                                    ->with('sambutan_kepsek', $sambutan_kepsek);
    }

    public function store(Request $request){
        $data = $request->all();
        
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'foto' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $data['sekolah_id'] = auth()->user()->id_sekolah;

        $sekolah_id = $data['sekolah_id'];

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('sambutan_kepsek', 'public');
        }

        SambutanKepsek::create([
            'judul' => $request->title,
            'deskripsi' => $request->content,
            'foto' => $data['foto'],
            'sekolah_id' => $sekolah_id,
        ]);

        return redirect()->back()->withSuccess('Data ditambahkan.');
    }

    public function update(Request $request){
        $data = $request->all();

        $rules = [
            'judul' => 'required',
            'deskrispsi' => 'deskripsi',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $sambutan_kepsek = SambutanKepsek::findOrFail($request->hidden_id);
        $foto = $sambutan_kepsek->foto;
        $data['foto'] = $sambutan_kepsek->foto;

        // if($request->file('foto')){
        //     if(Storage::disk('public')->exists($sambutan_kepsek->foto)){
        //         Storage::disk('public')->delete($sambutan_kepsek->foto);
        //     }
        //     $data['foto'] = $request->file('foto')->store('','public');
        // }

        $sambutan_kepsek->update($request->all());

        return response()
        ->json([
            'success' => 'Data berhasil diubah.',
        ]);
    }
}