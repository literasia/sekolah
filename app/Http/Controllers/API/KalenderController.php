<?php

namespace App\Http\Controllers\API;

use App\Models\Admin\Kalender;
use App\Http\Controllers\Controller;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function index($id, $date)
    {
        $data = Kalender::where('sekolah_id', "=", $id)->where('start_date', '=', $date)->get();
        if ($data->count() <= 0) {
            $message = 'Data not found !';
        } else {
            $message = 'Success get Data';
        }

        return response()->json(ApiResponse::success($data, $message));
    }
}
