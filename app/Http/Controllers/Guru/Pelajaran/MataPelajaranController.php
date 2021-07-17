<?php

namespace App\Http\Controllers\Guru\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Guru;
class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($request->ajax()) {
            // get data guru
            $guru = Guru::where('user_id', auth()->user()->id)->first();
            // get mata pelajaran yang dibawa oleh guru
            $mata_pelajaran = MataPelajaran::where('guru_id', $guru->id)->get();
          
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->make(true);
        }

        
     
        
    }

}
