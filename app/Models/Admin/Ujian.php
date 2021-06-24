<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Guru;
use App\Models\Admin\CbtSoal;
use App\Models\Admin\Penilaian;

class Ujian extends Model
{
    protected $guarded = ['id'];

    public function soal(){
        return $this->belongsTo(CbtSoal::class);
    }

    public function penilaian(){
        return $this->belongsTo(Penilaian::class);
    }
}
