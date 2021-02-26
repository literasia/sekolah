<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Superadmin\{KabupatenKota, Sekolah, Slider};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SliderController extends Controller
{
    public function index(Request $request){
    	$cities = KabupatenKota::all();
    	// $sliders = Slider::whereDate('start_date', '<=', Carbon::now()->toDateString())
    	// 				 ->whereDate('end_date', '>=', Carbon::now()->toDateString())->get();
    	$sliders = Slider::all();
    	return view('superadmin.slider', compact(['cities', 'sliders']));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'judul' 		=> 'required',
    		'kabupaten_kota'=> 'required',
    		'sekolah'		=> 'required',
    		'keterangan'	=> 'required',
    		'start_date'	=> 'required',
    		'end_date'		=> 'required',
    		'foto'			=> 'required|file|max:3072',
    	]);

    	$fileExtension = $request->foto->getClientOriginalExtension();
    	$fileName = Str::slug($request->judul."-".date("Y-m-d-H-i-s"), '-').".".$fileExtension;
    	$request->foto->storeAs('public/slider', $fileName);

    	$slider = Slider::create([
    		'judul'				=> $request->judul,
			'kabupaten_kota_id'	=> $request->kabupaten_kota,
			'keterangan'		=> $request->keterangan,
			'start_date'		=> date("Y-m-d", strtotime($request->start_date)),
			'end_date'			=> date("Y-m-d", strtotime($request->end_date)),
			'foto'				=> "slider/".$fileName
    	]);

    	foreach($request->sekolah as $sekolah){
    		$slider->sekolah()->attach($sekolah);
    	}

    	return response()->json(\App\Utils\ApiResponse::success(""));

    }
}
