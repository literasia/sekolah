<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DaftarNilai;
use App\Models\Admin\Materi;

class ReferensiMataPelajaran extends Model
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
