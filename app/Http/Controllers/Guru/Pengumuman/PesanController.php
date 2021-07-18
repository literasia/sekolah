<?php

namespace App\Http\Controllers\Guru\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Pesan;
use App\Models\Guru;
use App\User;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pesan = Pesan::where('user_id', Auth::id())->get();

        if ($request->ajax())
        {
            $guru = Guru::where('user_id', auth()->user()->id)->first();

            return DataTables::of($pesan)
                ->addColumn('action', function ($pesan) {
                    $button = '<button type="button" data-id="'.$pesan->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$pesan->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('judul', function($pesan){
                    return $pesan->judul;
                })
                ->addColumn('message_time', function($pesan){
                    return $pesan->end_date;
                })
                ->addColumn('tanggal_upload', function($pesan){
                    return $pesan->created_at;
                })
                ->addColumn('tampil_pada', function($pesan){
                    return $pesan->start_date;
                })
                ->addColumn('status', function($pesan){
                    return $pesan->status;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('guru.pengumuman.pesan', ['pesan' => $pesan, 'mySekolah' => User::sekolah()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $guru = Guru::where('user_id', auth()->user()->id)->first();

        $rules = [
            'judul' => 'required',
        ];   

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        Pesan::create([
            'judul' => $request->judul,
            'status' => $request->status,
            'guru_id' => $guru->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        return response()
            ->json([
                'success' => 'Data berhasil ditambah.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pesan = Pesan::findOrFail($id);

        return response()
            ->json([                
                'id'   => $pesan->id,
                'judul' => $pesan->judul,
                'status' => $pesan->status,
                'guru_id' => $pesan->user_id,
                'start_date' => $pesan->start_date,
                'end_date' => $pesan->end_date,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();

        $rules = [
            'judul' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'errors' => $validator->errors()
            ]);
        }

        $pesan = Pesan::findOrFail($request->hidden_id);

        $soal->update([
            'judul' => $request->judul,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);

        $pesan->delete();

        return response()
        ->json([
            'success' => 'Data berhasil dihapus.',
        ]);
    }
}
