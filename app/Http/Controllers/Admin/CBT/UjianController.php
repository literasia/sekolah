<?php

namespace App\Http\Controllers\Admin\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Kuis, Soal, PengaturanKuis, ButirSoal};
use App\Models\Guru;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UjianController extends Controller
{
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        return view('admin.cbt.ujian',['mySekolah' => User::sekolah(), 'addons' => $addons]); 
    }

    public function store(Request $request){
        //
    }

    public function edit($id){
        //
    }

    public function destroy($id, Request $request){
        //
    }
}