<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Superadmin\Addons;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Topik;
use Yajra\DataTables\DataTables;
use Validator;

class TopikController extends Controller
{
    public function index(Request $request) {
        $addons = Addons::where('user_id', auth()->user()->id)->first();
    
        if ($request->ajax()) {
            $data = Topik::orderBy("id","desc")->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="'.$data->id.'" class="edit btn btn-mini btn-info shadow-sm"><i class="fa fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-mini btn-danger shadow-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }


        return view("admin.forum.topik")->with('addons', $addons)
                                        ->with('mySekolah', User::sekolah());

    }

    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required',
        ];

        $message = [
            'judul.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Topik::create([
            'judul' => $request->input('judul')
        ]);

        return response()
            ->json([
                'success' => 'Data Ditambahkan.',
            ]);
    }

    public function edit($id){
        $topik = Topik::find($id);

        return response()
            ->json([
                'topik' => $topik,
            ]);
    }

    public function update(Request $request) {
        $rules = [
            'judul' => 'required',
        ];

        $message = [
            'judul.required' => 'Kolom ini tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all()
                ]);
        }

        Topik::whereId($request->hidden_id)->update([
            'judul' => $request->input('judul'),
        ]);

        return response()
            ->json([
                'success' => 'Data Updated.',
            ]);
    }

    public function destroy($id){
        $topik = Topik::find($id);
        $topik->delete();
    }
}
 