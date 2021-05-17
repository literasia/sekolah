<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin\Addons;

class ForumController extends Controller
{

    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        return view('admin.forum.forum',['mySekolah' => User::sekolah(), 'addons' => $addons]);   
    }
}

//