<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\{PengaturanForum, PenggunaForum, RoleForum};
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
        
        // cek jika akses level ditetapkan secara otomatis
        if ($request->permission_access_level == 1) {
             
            $pengguna_forum = PenggunaForum::where('sekolah_id', auth()->user()->id_sekolah)->get();
            $role_forum = RoleForum::where('name', $request->peran)->first();
           
            foreach($pengguna_forum as $item){
                $pengguna_forum = PenggunaForum::findOrFail($item->id);
                // detach pengguna forum
                $pengguna_forum->roleForum()->detach();
                // attach to pivot
                $pengguna_forum->roleForum()->attach($role_forum->id);
            }
        }


        $pengaturan_forum->update([
            'permission_access_level' => $request->permission_access_level != null ? 1 : 0,
            'access_level' => $request->peran,
            'permission_posting_limit' => $request->permission_posting_limit != null ? 1 : 0,
            'posting_limit_time' => $request->posting_limit_time != null ? $request->posting_limit_time : 0,
            'permission_edit_content'=> $request->permission_edit_content != null ? 1 : 0,
            'edit_limit_time'=> $request->edit_limit_time != null ? $request->edit_limit_time : 0,
            'permission_guest_account' => $request->permission_guest_account != null ? 1 : 0,
            'auto_embeded_link'=> $request->auto_embeded_link != null ? 1 : 0,
            'permission_reply_thread'=> $request->permission_reply_thread != null ? 1 : 0,
            'amount_reply_thread'=> $request->amount_reply_thread != null ? $request->amount_reply_thread : 0,
            'permission_revisions'=> $request->permission_revisions != null ? 1 : 0,
            'permission_search'=> $request->permission_search != null ? 1 : 0,
            'permission_post_formating'=> $request->permission_post_formating != null ? 1 : 0,
            'permission_forum_moderator'=> $request->permission_forum_moderator != null ? 1 : 0,
            'permission_super_moderator'=> $request->permission_super_moderator != null ? 1 : 0,
            'amount_page_topic'=> $request->amount_page_topic != null ? $request->amount_page_topic : 1,
            'amount_page_reply'=> $request->amount_page_reply != null ? $request->amount_page_reply : 1,
        ]);

        return redirect()->back();
    }
}
