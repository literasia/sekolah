<?php

namespace App\Http\Controllers\Admin\Pelajaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD

class MataPelajaranController extends Controller
{

    public function index() {
        return view('admin.pelajaran.mata-pelajaran');
=======
use DataTables;
use App\Models\Guru;
use App\Models\MataPelajaran;
class MataPelajaranController extends Controller
{

    public function index(Request $request) {
        if($request->req == 'table') {
            return DataTables::of(MataPelajaran::get())->addIndexColumn()->toJson();
        }
        if($request->req == 'single') {
            return response()->json(MataPelajaran::findOrFail($request->id));
        }
        $guru = Guru::all();
        return view('admin.pelajaran.mata-pelajaran', compact('guru'));
    }

    public function write(Request $request) {
        if($request->req == 'write') {
            $obj = MataPelajaran::find($request->id);
            
            if(!$obj){
                $obj = new MataPelajaran();
            }

            $obj->nama_pelajaran = $request->nama_pelajaran;
            $obj->kode_pelajaran = $request->kode_pelajaran;
            $obj->guru_id = 1; //$request->guru_id;
            $obj->aktif = $request->aktif == 'on';
            $obj->keterangan = $request->keterangan;
            $obj->save();
            return response()->json($obj);
            
            
        }
        elseif($request->req == 'delete') {
            MataPelajaran::find($request->id)->delete();
        }
>>>>>>> d3e253c48f5c13cb64b572ebeb26a176538a51f9
    }
}
