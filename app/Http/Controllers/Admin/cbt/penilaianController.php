<?php

namespace App\Http\Controllers\Admin\CBT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Penilaian;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $penilaian = Penilaian::all();
        if ($request->ajax()) {
            $penilaian = Penilaian::latest()->get();
            return Datatables::of($penilaian)
                    ->addIndexColumn()
                    ->addColumn('action', function($penilaian){
                        $button = '<button type="button" data-id="'.$penilaian->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$penilaian->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                        return $button;
                    })
                    ->addColumn('nama', function ($penilaian){
                        return $penilaian->nama;
                    })
                    ->addColumn('poin_jk_benar', function ($penilaian){
                        return $penilaian->poin_jk_benar;
                    })
                    ->addColumn('poin_jk_salah', function ($penilaian){
                        return $penilaian->poin_jk_salah;
                    })
                    ->addColumn('poin_jk_kosong', function ($penilaian){
                        return $penilaian->poin_jk_kosong;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.cbt.penilaian')
                                        ->with('mySekolah', User::sekolah())
                                        ->with('addons', $addons)
                                        ->with('penilaians', $penilaian)
                                        ; 
        
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'nama' => 'required',
            'poin_jk_benar' => 'required',
            'poin_jk_salah' => 'required',
            'poin_jk_kosong' => 'required',
            'pengali_jk_benar' => 'required',
            'pengali_jk_salah' => 'required',
            'pengali_jk_kosong' => 'required',
        ];
        
        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        Penilaian::create([
            'sekolah_id' => auth()->user()->id_sekolah,
            'nama' => $request->nama,
            'poin_jk_benar' => $request->poin_jk_benar,
            'poin_jk_salah' => $request->poin_jk_salah,
            'poin_jk_kosong' => $request->poin_jk_kosong,
            'pengali_jk_benar' => $request->pengali_jk_benar,
            'pengali_jk_salah' => $request->pengali_jk_salah,
            'pengali_jk_kosong' => $request->pengali_jk_kosong,
        ]);
    
        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    public function edit($id){
        $penilaian = Penilaian::findOrFail($id);

        return response()
            ->json([                
                'id'   => $penilaian->id,
                'nama' => $penilaian->nama,
                'poin_jk_benar' => $penilaian->poin_jk_benar,
                'poin_jk_salah' => $penilaian->poin_jk_salah,
                'poin_jk_kosong' => $penilaian->poin_jk_kosong,
                'pengali_jk_benar' => $penilaian->pengali_jk_benar,
                'pengali_jk_salah' => $penilaian->pengali_jk_salah,
                'pengali_jk_kosong' => $penilaian->pengali_jk_kosong,
            ]);
    }

    public function update(Request $request){
        $data = $request->all();

        $rules = [
            'nama' => 'required',
            'poin_jk_benar' => 'required',
            'poin_jk_salah' => 'required',
            'poin_jk_kosong' => 'required',
            'pengali_jk_benar' => 'required',
            'pengali_jk_salah' => 'required',
            'pengali_jk_kosong' => 'required',
        ];
        
        $validator = Validator::make($data, $rules);

        // Validation Rules 
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $penilaian = Penilaian::findOrFail($request->hidden_id);
        
        $penilaian->update($data);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    public function destroy($id){
        $penilaian = Penilaian::findOrFail($id);

        $penilaian->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
