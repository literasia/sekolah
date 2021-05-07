<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{

    public function index(Request $request) {
        return view('admin.forum.forum',['mySekolah' => User::sekolah()]);   
    }
}

//wt rewt