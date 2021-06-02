<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ButirSoal extends Model
{
    protected $guarded = ['id'];

    public function soal(){
        return $this->belongsTo(Soal::class);
    }
}