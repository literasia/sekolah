<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;
use App\Models\CbtSoal;

class Ujian extends Model
{
    protected $guarded = ['id'];

    public function soal(){
        return $this->belongsTo(CbtSoal::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }
}
