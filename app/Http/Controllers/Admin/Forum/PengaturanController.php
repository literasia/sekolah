<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\PengaturanForum;
use Illuminate\Support\Facades\Validator;

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

    public function update(Request $request){
        $data = $request->all();
        $id = $data['hidden_id'];
        $pengaturan_forum = PengaturanForum::findOrFail($id);
        dd($data);

        $rules=[
            'permission_acces_level' => 'required',
            'access_level' => 'required',
            'permission_posting_limit' => 'required',
            'posting_limit_time' => 'required',
            'permission_edit_content' =>'required',
            'edit_limit_time' => 'required',
            'permission_guest_account' => 'required',
            'auto_embeded_link' => 'required',
            'permission_reply_thread' => 'required',
            'amount_page_reply' =>'required',
        ];

        $validator = Validator::make($data, $rules);

        $pengaturan_forum->update([
            'permission_acces_level' => $request->permission_acces_level,
            'access_level' => $request->peran,
            'permission_posting_limit' => $request->permission_posting_limit,
            'posting_limit_time' => $request->has('posting_limit_time'),
            'permission_edit_content'=> $request->permission_edit_content,
            'edit_limit_time'=> $request->has('edit_limit_time'),
            'permission_guest_account' => $request->has('permission_guest_account'),
            'auto_embeded_link'=> $request->auto_embeded_link,
            'permission_reply_thread'=> $request->has('permission_reply_thread'),
            'amount_reply_thread'=> $request->has('amount_reply_thread'),
            'permission_revisions'=> $request->permission_revisions,
            'permission_search'=> $request->permission_search,
            'permission_post_formating'=> $request->has('permission_post_formating'),
            'permission_forum_moderator'=> $request->has('permission_forum_moderator'),
            'permission_super_moderator'=> $request->has ('permission_super_moderator'),
            'amount_page_topic'=> $request->has('amount_page_topic'),
            'amount_page_reply'=> $request->has('amount_page_reply'),
        ]);

        return redirect()->back();
    }
}
