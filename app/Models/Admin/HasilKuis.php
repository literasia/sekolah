<?php

namespace App\Models\Admin;
use App\Models\Admin\Kuis;
use App\Models\Siswa;

use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    protected $guarded = ['id'];

    public function kuis(){
        return $this->belongsTo(Kuis::class);
    }

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class);
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
}
