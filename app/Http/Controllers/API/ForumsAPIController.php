<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\{Forum, Topik, PenggunaForum, BalasanForum};
use App\Models\{UserLikeForum, UserBookmarkForum};
use Illuminate\Support\Facades\Validator;
use App\Utils\ApiResponse;


class ForumsAPIController extends Controller
{

    public function getTopik(Request $request, $sekolah_id){
        $data = $request->all();
        
        $topik = Topik::where('sekolah_id', $sekolah_id)->get();
        
        return response()->json(ApiResponse::success($topik, 'Success get data'));
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
        ];

        $tp = ['total_postingan' => $total_postingan];

        PenggunaForum::updateOrCreate($pengguna_forums, $tp);

        return response()->json(ApiResponse::success($forum, 'Success add data'));
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
}
