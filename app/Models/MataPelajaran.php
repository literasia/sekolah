<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DaftarNilai;
class MataPelajaran extends Model
{
    public function guru() {
        return $this->belongsTo(Guru::class);
    }

    public function daftarNilai()
    {
    	return $this->hasMany(DaftarNilai::class);
    }
}
