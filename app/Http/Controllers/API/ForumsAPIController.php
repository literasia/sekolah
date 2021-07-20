<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Forum, Topik, PenggunaForum, BalasanForum, PengaturanForum, RoleForum, UserReadForum};
use App\Models\{UserLikeForum, UserBookmarkForum};
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Utils\ApiResponse;


class ForumsAPIController extends Controller
{

    public function getTopik(Request $request, $sekolah_id){
        $data = $request->all();
        
        $topik = Topik::where('sekolah_id', $sekolah_id)->get();
        
        return response()->json(ApiResponse::success($topik, 'Success get data'));
    }

    public function getForum($sekolah_id, User $user){
        $pengaturan_forum = PengaturanForum::where('sekolah_id', $sekolah_id)->first();

        if ($pengaturan_forum == null) {
            $pengaturan_forum = PengaturanForum::create([
                'sekolah_id' => $sekolah_id,
                'permission_access_level' => 0,
                'permission_posting_limit'=> 0,
                'posting_limit_time'=> 0,
                'permission_edit_content'=> 1,
                'edit_limit_time'=> 0,
                'permission_guest_account'=> 0,
                'auto_embeded_link'=>  1,
                'permission_reply_thread'=> 0,
                'amount_reply_thread'=> 2,
                'permission_revisions'=> 1,
                'permission_topic_favorit'=> 1,
                'permission_search'=> 1,
                'permission_post_formating'=> 0,
                'permission_forum_moderator'=> 0,
                'permission_super_moderator'=> 0,
                'amount_page_topic'=> 0,    
                'amount_page_reply'=> 0,
                'access_level' => null,
            ]);
        }

        $pengguna_forum = PenggunaForum::where('user_id', $user->id)->first();
        $role_forum = RoleForum::where('name', 'peserta')->first();
        
        if($pengguna_forum != null){
            $pengguna_forum->roleForum()->detach();
        }

        $pengguna_forum->roleForum()->attach($role_forum->id);

        // cek jika akses level ditetapkan secara otomatis
        if ($pengaturan_forum->permission_access_level) {
            $pengguna_forum = PenggunaForum::where('sekolah_id', $sekolah_id)->get();
            $role_forum = RoleForum::where('name', $pengaturan_forum->access_level)->first();
           
            foreach($pengguna_forum as $item){
                $pengguna_forum = PenggunaForum::findOrFail($item->id);
                // detach pengguna forum
                $pengguna_forum->roleForum()->detach();
                // attach to pivot
                $pengguna_forum->roleForum()->attach($role_forum->id);
            }
        }

        $data_forum = Forum::where('sekolah_id', $sekolah_id)->with('topik')->with('user')->get();
        $forum = [];

        foreach ($data_forum as $item) {
            // get bookmark forum of user
            $is_bookmark_forum = UserBookmarkForum::where('user_id', $user->id)->where('forum_id', $item->id)->first();
            // get like forum of user
            $is_like_forum = UserLikeForum::where('user_id', $user->id)->where('forum_id', $item->id)->first();
            // number of forums read
            $amount_of_read_forum = UserReadForum::where('forum_id', $item->id)->count();
            
            setlocale(LC_TIME, 'id_ID');
            \Carbon\Carbon::setLocale('id');
            
            
            // push to forum array
            array_push($forum, [
                "id" => $item->id,
                "sekolah_id" => $item->sekolah_id,
                "topik_id" => $item->topik_id,
                "user_id" => $item->user_id,
                "judul" => $item->judul,
                "total_balasan" => $item->total_balasan,
                "privasi" => $item->privasi,
                "konten" => $item->konten,
                "created_by" => $item->user->name,
                "created_at" => \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y'),
                "updated_at" => \Carbon\Carbon::parse($item->updated_at)->isoFormat('dddd, D MMMM Y'),
                "topik" => [
                    "id" => $item->topik->id,
                    "judul" => $item->topik->judul,
                    "popularitas" => $item->topik->popularitas
                ],
                "amount_of_read_forum" => $amount_of_read_forum,
                "is_like_forum" => $is_like_forum != null ? 1 : 0,
                "is_bookmark_forum" => $is_bookmark_forum != null ? 1 : 0,
            ]);
        }

        return response()->json(ApiResponse::success(['forum' => $forum, 
                                                      'pengaturan_forum' => $pengaturan_forum,
                                                    ]));        
    }

    public function addForum(Request $request, $sekolah_id, $topik_id, $user_id, $kelas_id){
        $rules = [
            'judul'  => 'required|max:255',
        ];  

        $message = [
            'judul.required' => 'This column judul cannot be empty',
        ];

        $data = $request->all();

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        // $data['image'] = null;
        // if ($request->file('image')) {
        //     $data['image'] = $request->file('image')->store('ahli waris', 'public');
        // }
        
        
        $forum = Forum::create([
            'sekolah_id' => $sekolah_id,
            'topik_id' => $topik_id,
            'user_id' => $user_id,
            'judul' => $data['judul'],
            'privasi' => $data['privasi'],
            'total_balasan' => 0,
        ]);
        
        
        $judul = Topik::where('id', $topik_id)->get()[0];
        
        $popularitas = [
            'sekolah_id' => $sekolah_id,
            'judul' => $judul['judul'],
        ];
        
        $pop = ['popularitas' => Forum::where('topik_id', $topik_id)->count()];

        Topik::updateorCreate($popularitas, $pop);

        $total_postingan = Forum::where('user_id', $user_id)->count();

        $pengguna_forums = [
            'user_id' => $user_id,
            'kelas_id' => $kelas_id,
            'sekolah_id' => $sekolah_id
        ];

        $tp = ['total_postingan' => $total_postingan];

        PenggunaForum::updateOrCreate($pengguna_forums, $tp);

        return response()->json(ApiResponse::success($forum, 'Success add data'));
    }

    public function getComment(Forum $forum, Request $request){
        $comments = BalasanForum::where('forum_id', $forum->id)->with('user')->paginate(30);

        return response()->json(ApiResponse::success(['comments' => $comments]));
    }

    public function addComment(Request $request, $sekolah_id, $forum_id, $user_id){
        $rules = [
            'komentar'  => 'required|max:255',
        ];

        $message = [
            'komentar.required' => 'This column komentar cannot be empty',
        ];

        $data = $request->all();

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        // $data['image'] = null;
        // if ($request->file('image')) {
        //     $data['image'] = $request->file('image')->store('ahli waris', 'public');
        // }
        
        
        $balasan_forum = BalasanForum::create([
            'sekolah_id' => $sekolah_id,
            'forum_id' => $forum_id,
            'user_id' => $user_id,
            'komentar' => $data['komentar'],
            'balasan_id' => $data['balasan_id'],
        ]);

        return response()->json(ApiResponse::success($balasan_forum, 'Success add data'));
    }

    public function like($id, Request $req) {
        $data = $req->all();
        $data['is_like'] = ($data['is_like'] == 'true');
        $like = UserLikeForum::where([
            ['user_id', $data['user_id']],
            ['forum_id', $id]
        ])->first();

        if ($like && !$data['is_like']) {
            $like->delete();
        } else if (!$like && $data['is_like']) {
            UserLikeForum::create([
                'user_id' => $data['user_id'],
                'forum_id' => $id
            ]);
        }

        return response()->json(ApiResponse::success([]));
    }

    public function bookmark($id, Request $req) {
        $data = $req->all();
        $data['is_bookmark'] = ($data['is_bookmark'] == 'true');
        $like = UserBookmarkForum::where([
            ['user_id', $data['user_id']],
            ['forum_id', $id]
        ])->first();

        if ($like && !$data['is_bookmark']) {
            $like->delete();
        } else if (!$like && $data['is_bookmark']) {
            UserBookmarkForum::create([
                'user_id' => $data['user_id'],
                'forum_id' => $id
            ]);
        }

        return response()->json(ApiResponse::success([]));
    }

    public function updateReadForum(User $user, Forum $forum, Request $request){
        $user_read_forum = UserReadForum::where('user_id', $user->id)->first();

        // jika data belum ada maka tambahkan
        if($user_read_forum == null){
            $user_read_forum = UserReadForum::create([
                'user_id' => $user->id,
                'forum_id' => $forum->id,
            ]);
        }

        return response()->json(ApiResponse::success(['user_read_forum' => $user_read_forum]));
    }
}
