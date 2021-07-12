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
        $sambutan_kepsek = SambutanKepsek::where('sekolah_id', auth()->user()->id_sekolah)->first();

        // jika data sambutan kepsek belum ada, maka tambahkan
        if ($sambutan_kepsek == null) {
            SambutanKepsek::create([
                'sekolah_id' => auth()->user()->id_sekolah,
                'judul' => 'judul sambutan...',
                'foto' => null,
                'deskripsi' => 'isi sambutan..'
            ]);
        }

        // get data kembali
        $sambutan_kepsek = SambutanKepsek::where('sekolah_id', auth()->user()->id_sekolah)->first();
        
        return view('admin.sambutan.sambutan')   
                                    ->with('addons', $addons)
                                    ->with('mySekolah', User::sekolah())
                                    ->with('sambutan_kepsek', $sambutan_kepsek);
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
        $data['foto'] = $sambutan_kepsek->foto;

        if($request->file('foto')){
            if(Storage::disk('public')->exists($sambutan_kepsek->foto)){
                Storage::disk('public')->delete($sambutan_kepsek->foto);
            }
            $data['foto'] = $request->file('foto')->store('sambutan','public');
        }

        $sambutan_kepsek->update($data);

        return redirect()->back();
    }
}