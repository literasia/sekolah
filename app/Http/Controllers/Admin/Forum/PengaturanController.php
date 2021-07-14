<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\PengaturanForum;

class PengaturanController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
        $pengaturan_forum = PengaturanForum::where('sekolah_id', auth()->user()->id_sekolah)->first();

        if ($pengaturan_forum == null) {
            PengaturanForum::create([
                'sekolah_id' => auth()->user()->id_sekolah,
                'posting_limit_time' => 0,
                'edit_limit_time' => 0,
                'amount_page_topic' => 0,
                'amount_page_reply' => 0,
                'amount_reply_thread' =>2,
            ]);
        }
        
        $pengaturan_forum = PengaturanForum::where('sekolah_id', auth()->user()->id_sekolah)->first();
        

        return view('admin.forum.pengaturan-forum')
                                            ->with('addons', $addons)
                                            ->with('mySekolah', User::sekolah())
                                            ->with('pengaturan_forum', $pengaturan_forum);   
    }
}
