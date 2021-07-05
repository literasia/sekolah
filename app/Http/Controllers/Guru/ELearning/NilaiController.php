<?php

namespace App\Http\Controllers\Guru\Elearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, Siswa};
use App\Models\Admin\{HasilKuis, Kuis, Kelas};
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->kelas_id;
        $kuis_id = $request->kuis_id;
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $kelas = Kelas::whereHas('user', function($query){
            $query->where('id_sekolah', auth()->user()->id_sekolah);
        })->get();

        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $kuis = Kuis::all();

        
        return view('guru.e-learning.nilai')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('addons', $addons)
                                    ->with('kelas', $kelas)
                                    ->with('kuis', $kuis)
                                    ->with('kelas_id', $kelas_id)
                                    ->with('kuis_id', $kuis_id);
    }
}
