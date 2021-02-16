<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Helpers\ResponseFormatter;

class MataPelajaranController extends Controller
{
    public function read(Request $request) {
        if($request->req == 'table') {
            $data = MataPelajaran::where(function($q) use($request){
                $q->where('nama_pelajaran', 'like', "%$request->search%");
            })->paginate($request->per_page);
            return ResponseFormatter::success($data);
        }
        if($request->req == 'single') {
            $obj = MataPelajaran::find($request->id);
            return $obj ? ResponseFormatter::success($obj) : ResponseFormatter::error(null, 'Data tidak ditemukan');
        }

    }

    public function write(Request $request) {
        
        if($request->req == 'write') {
            $obj = MataPelajaran::find($request->id);
            
            if(!$obj){
                $obj = new MataPelajaran();
            }

            $obj->nama_pelajaran = $request->nama_pelajaran;
            $obj->kode_pelajaran = $request->kode_pelajaran;
            $obj->guru_id = $request->guru_id;
            $obj->aktif = $request->aktif;
            $obj->keterangan = $request->keterangan;
            return $obj->save() ? 
                 ResponseFormatter::success($obj, 'Data berhasil disimpan') : ResponseFormatter::error(null, 'Something went wrong'); 
            
        }
        elseif($request->req == 'delete') {
            $obj = MataPelajaran::find($request->id);
            if(!$obj)
                return ResponseFormatter::error(null, 'Data tidak ditemukan');
            
            $obj->delete();

            return ResponseFormatter::success('Data telah dihapus');
        }
    }
    
}
