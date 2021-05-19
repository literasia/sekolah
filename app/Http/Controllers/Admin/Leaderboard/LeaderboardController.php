<?php

namespace App\Http\Controllers\Admin\Leaderboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{ //
    public function index(Request $request) {
        return view('admin.leaderboard.leaderboard',['mySekolah' => User::sekolah()]);   
    }
}