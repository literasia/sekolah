<?php

namespace App\Http\Controllers\Admin\Import;

use App\User;
use Session;
use App\Http\Controllers\Controller;
use App\Utils\CRUDResponse;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Superadmin\Addons;

class SiswaController extends Controller
{ //
	public function index(){
        $addons = Addons::where('user_id', auth()->user()->id)->first();

    	return view('admin.import.import-siswa', ['mySekolah' => User::sekolah(), 'addons' => $addons]);
	}

    public function import_excel(Request $request){
    	$data = $request->all();
    	// validasi
		// $this->validate($request, [
		// 'file' => 'required|mimes:csv,xls,xlsx'
		// ]);
		// menangkap file excel
		// $file = $request->file('file');
		$data['file'] = null;
        if ($request->file('file')) {
            $data['file'] = $request->file('file')->store('file_siswa', 'public');
        }

		// membuat nama file unik
		// $nama_file = rand().$request->file('file')->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		// $file->move('file_siswa',$nama_file);

		// import data 
		// yang ini jangan dihapus ya
		// Excel::import(new SiswaImport, public_path('/file_siswa/'.$nama_file));
		// $siswa = Excel::import(new SiswaImport, storage_path('/app/public/'.$data['file']));


		// pakai ini
		try {
			Excel::import(new SiswaImport, storage_path('/app/public/'.$data['file']));
			// dd($siswa);g
			// notifikasi dengan session
			Session::flash('success','Data Siswa Berhasil Diimport!');
		}
		catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
			$failures = $e->failures();
			foreach ($failures as $failure) {
				$row = $failure->row(); 
				$attribute = $failure->attribute(); 
				$errors = $failure->errors(); 
				$values = $failure->values(); 
			}

			if ($errors[0] == "The username has already been taken.") {
				Session::flash('username_error','Error Baris Excel : '.$row.' Kesamaan data pada username : '.$values['username']);			
			}
		}

		// alihkan halaman kembali
		return redirect()->route('admin.import.import-siswa')->with(CRUDResponse::successCreate("Data Siswa"));

    }
}
