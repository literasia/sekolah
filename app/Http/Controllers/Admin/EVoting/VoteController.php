<?php

namespace App\Http\Controllers\Admin\EVoting;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index() {
        return view('admin.e-voting.vote', ['mySekolah' => User::sekolah()]);
    }
}
