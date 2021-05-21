<?php

namespace App\Http\Controllers\Admin\Referensi;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Pegawai;
use App\Models\Admin\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class PengaturanHakAksesController extends Controller
{ //
    public function index() {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
    	// $pegawais = Pegawai::where(['user_id'=>auth()->user()->id])->get();
        $pegawais = Pegawai::whereHas('user', function($q) {
            return $q->whereIdSekolah(auth()->user()->id_sekolah);
        })->get();
    	// dd($pegawais[0]->access);
        return view('admin.referensi.pengaturan-hak-akses', [
        	'mySekolah' => User::sekolah(),
        	'pegawais'	=> $pegawais,
			'addons' => $addons
        ]);
    }

    public function update(Request $request)
    {
    	$pegawai_id    = $request->pegawai_id;
    	$isChecked     = $request->isChecked;
    	$structure     = $request->structure;

    	$access = Access::where('pegawai_id', $pegawai_id)->first();
    	$access->{$structure} = $isChecked=='true'?1:0;
    	// dd($access);
    	$access->save();
    }
}
