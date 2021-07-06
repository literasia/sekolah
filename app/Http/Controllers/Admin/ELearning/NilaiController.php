<?php

namespace App\Http\Controllers\Admin\ELearning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Superadmin\Addons;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        return view('admin.e-learning.nilai')
                                    ->with('mySekolah', User::sekolah())
                                    ->with('addons', $addons);
    }

}