<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        return view('admin.forum.pengguna',['mySekolah' => User::sekolah(), 'addons' => $addons]);   
    }
}