<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DaftarNilai;
use App\Models\Admin\Materi;

class MataPelajaran extends Model
{
    public function guru() {
        return $this->belongsTo(Guru::class);
    }

    public function daftarNilai()
    {
    	return $this->hasMany(DaftarNilai::class);
    }

    public function materi(){
        return $this->hasMany(Materi::class);
    }

    public function soal(){
        return $this->hasMany(Soal::class);
    }
}
