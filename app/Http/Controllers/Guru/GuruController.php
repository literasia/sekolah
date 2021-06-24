<?php

namespace App\Http\Controllers\Guru;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Superadmin\{Sekolah, Provinsi, KabupatenKota};
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index() {
    	// dd(auth()->user()->pegawai->access->kalender);
        return view('guru.index');
    }

    public function show(Request $request)
    {
        $profile = Sekolah::findOrFail(auth()->user()->id_sekolah);
        $provinsi = Provinsi::findOrFail($profile->provinsi);
        $kabupaten = KabupatenKota::findOrFail($provinsi->id);
        $user = User::where('id_sekolah', $profile->id)->first();

        return response()->json([
            'id_sekolah' => $profile->id_sekolah,
            'name' => $profile->name,
            'alamat' => $profile->alamat,
            'jenjang' => $profile->jenjang,
            'tahun_ajaran' => $profile->tahun_ajaran,
            'provinsi' => $provinsi->name,
            'kabupaten' => $kabupaten->name,
            'username' => auth()->user()->username,
        ]);
    }

    public function update(Request $request){
        $profile = Sekolah::findOrFail(auth()->user()->id_sekolah);
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $profile->update([
            'alamat' => $request->alamat
        ]);


        $filename = null;
        if($request->hasFile("image")){
            $image = $request->file("image");
            $filename = time()."-".$image->getClientOriginalName();
            $image->move(public_path('profile_images'),$filename);
            $user = User::findOrFail(auth()->user()->id);
            $user->update([
                'image' => $filename
            ]);

        }

        if (!empty($request->password_lama)) {
            if(Hash::check($request->password_lama, auth()->user()->password)){
                // If Password lama != password db
                if($request->confirmation_password == $request->password_baru){
                    $user = User::findOrFail(auth()->user()->id);
                    $user->update([
                        'password' => Hash::make($request->password_baru),
                    ]);
                    return response()->json([
                        'success' => true,
                        "message" => 'data berhasil diubah'
                    ]);
                }else{
                    return response()->json([
                        'success' => false,
                        "message" => 'password tidak sama'
                    ]);
                }
            }else{
                return response()->json([
                    'success' => false,
                    "message" => 'password lama salah'
                ]);
            }
        }
        return response()->json([
            'success' => true,
            "message" => 'data berhasil diubah',
            "image" => $request->hasFile("image") ? $filename : ""
        ]);
    }
}
