<?php

namespace App\Http\Controllers\Admin\Sekolah;

use App\User;
use Validator;
use App\Models\Superadmin\Sekolah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TahunAjaranController extends Controller
{
	public function index(Request $request) {

		// $tahun_ajaran = Sekolah::where('tahun_ajaran')
		// 					->where('id', auth()->user()->id_sekolah)
		// 					->get();
		$tahun_ajaran = Sekolah::where('id', auth()->user()->id_sekolah)->get();

		// dd($tahun_ajaran);

		return view('admin.sekolah.tahun-ajaran', ['tahun_ajaran' => $tahun_ajaran, 'mySekolah' => User::sekolah()]);
	}

	public function update(Request $request)
	{
		$id     = $request->id;
		$isChecked      = $request->isChecked;
		$structure      = $request->structure;
		// dd($structure);


		$tahun_ajaran = Sekolah::where('id', $id)->first();
		$tahun_ajaran->$structure = $isChecked == 'true' ? "Ganjil":"Genap";
		// dd($tahun_ajaran->$structure);
		$tahun_ajaran->save();
	}
}
