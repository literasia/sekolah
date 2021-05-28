<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;

class Soal extends Model
{
    protected $guarded = ['id'];

    public function kuis(){
        return $this->hasMany(Kuis::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class);
    }
}
