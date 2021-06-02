<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Superadmin\{Sekolah, Provinsi, KabupatenKota};
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
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
            'username' => $user->username,
        ]);
    }

    public function changeProfile(Request $request){

        $profile = Sekolah::findOrFail(auth()->user()->id_sekolah);

        $profile->update([
            'alamat' => $request->alamat
        ]);

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


    }
}
