<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\{KabupatenKota, Provinsi, Sekolah, Slider};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Utils\CRUDResponse;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    private $rules = [
        'judul' => ['required'],
        'kabupaten_kota' => ['required'],
        'start_date' => ['required'],
        'end_date' => ['required'],
        'keterangan' => ['required'],
        'foto' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000']
    ];

    public function index(Request $request)
    { //
        $cities = KabupatenKota::all();
        $provinsi = Provinsi::get();

        if ($request->ajax()) {
            $data = Slider::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->addColumn('foto', function ($data) {
                    $btnlink = '<a target="_blank" href="'.Storage::url($data->foto).'" class="badge badge-warning">Lihat Foto</a>';
                    return $btnlink;
                })
                ->editColumn('kabupaten_kota_id', function ($data) {
                    return $data->kabupatenKota->name;
                })
                ->rawColumns(['action', 'foto'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('superadmin.slider', compact(['cities', 'provinsi']));
    }

    public function store(Request $request)
    {
        $rules = [
            'judul'         => 'required',
            'kabupaten_kota' => 'required',
            'sekolah'       => 'required',
            'keterangan'    => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'foto'          => 'required|file|max:3072',
         ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        // Validation rules
        if ($validator->fails()) {
            return response()->json([
                'error' => "Data masih kosong",
                'errors' => $validator->errors()
            ]);
        }

        $fileExtension = $request->foto->getClientOriginalExtension();
        $fileName = Str::slug($request->judul . "-" . date("Y-m-d-H-i-s"), '-') . "." . $fileExtension;
        $request->foto->storeAs('public/slider', $fileName);

        $slider = Slider::create([
            'judul'             => $request->judul,
            'no_urut'           => $request->no_urut,
            'provinsi_id'       => $request->provinsi,
            'kabupaten_kota_id' => $request->kabupaten_kota,
            'keterangan'        => $request->keterangan,
            'start_date'        => date("Y-m-d", strtotime($request->start_date)),
            'end_date'          => date("Y-m-d", strtotime($request->end_date)),
            'foto'              => "slider/" . $fileName
        ]);

        foreach ($request->sekolah as $sekolah) {
            $slider->sekolah()->attach($sekolah);
        }

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
        ]);
    }


    public function edit($id)
    {
        $cities = KabupatenKota::all();
        // $slider = Slider::select('kabupaten_kotas.name', 'sliders.*')->where('sliders.id', $id)->join('kabupaten_kotas', 'sliders.kabupaten_kota_id', 'kabupaten_kotas.id')->get();
        $sekolah = DB::table('sekolah_slider')->select('*')->where('slider_id', $id)->get();
    
        $slider = Slider::findOrFail($id);
        return response()->json([
            'id' => $slider->id,
            'judul' => $slider->judul,
            'no_urut' => $slider->no_urut,
            'provinsi_id' => $slider->provinsi_id,
            'kabupaten_kota_id' => $slider->kabupaten_kota_id,
            'keterangan' => $slider->keterangan,
            'start_date' => $slider->start_date,
            'end_date' => $slider->end_date,
            'sekolah' => $sekolah
        ]);
    }

    public function update(Request $req)
    {
        $data = $req->all();

        $validator = Validator::make($data, $this->rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->all())->withInput();
        }

        $slider = Slider::findOrFail($req['hidden_id']);
        
        $data['foto'] = null;
        if ($req->file('foto')) {
            $data['foto'] = $req->file('foto')->store('slider', 'public');
        }

        $slider->update([
            'judul' => $data['judul'],
            'no_urut' => $data['no_urut'],
            'provinsi_id' => $data['provinsi'],
            'kabupaten_kota_id' => $data['kabupaten_kota'],
            'keterangan' => $data['keterangan'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'foto' => $data['foto'] ?? $slider->foto
        ]);
        
        $slider->sekolah()->detach();

        foreach ($req->sekolah as $sekolah) {
            $slider->sekolah()->attach($sekolah);
        }

        if ($req->file('foto') && $slider->foto && Storage::disk('public')->exists($slider->foto)) {
            Storage::disk('public')->delete($slider->foto);
        }

        return response()
                    ->json([
                        'success' => 'Data berhasil dihapus.',
                    ]);
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        if ($slider->foto && Storage::disk('public')->exists($slider->foto)) {
            Storage::disk('public')->delete($slider->foto);
        }

        return response()
                    ->json([
                        'success' => 'Data berhasil dihapus.',
                    ]);
    }
}
