<?php

namespace App\Http\Controllers\Siswa\Kalender;

use App\Models\Admin\Kalender;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    public function index(Request $request)
    {
        $datas = [];
        $data = Kalender::where('sekolah_id', auth()->user()->id_sekolah)->orderBy('created_at')->get();
        foreach ($data as $d) {
            $datas[] = (object) array('id' => $d->id, 'title' => $d->title, 'start' => $d->start_date . ' ' . $d->start_clock, 'end' => $d->end_date . ' ' . $d->end_clock, 'className' => $d->prioritas);
        }

        $events = json_encode($datas);

        return view('siswa.kalender.kalender-akademik', ['mySekolah' => User::sekolah(), compact('events')]);
    }
}
