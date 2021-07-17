<?php

namespace App\Http\Controllers\Guru\Kalender;

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

        return view('guru.kalender.kalender-akademik', ['mySekolah' => User::sekolah(), compact('events')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
