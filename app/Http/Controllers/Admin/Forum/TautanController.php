<?php

namespace App\Http\Controllers\Admin\Forum;

use Validator;
use App\Models\BagianPegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class TautanController extends Controller
{ //
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();

        return view('admin.forum.tautan', ['mySekolah' => User::sekolah(), 'addons' => $addons]);
    }

    public function store(Request $request) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request) {
        //
    }

    public function destroy($id) {
        //
    }
}