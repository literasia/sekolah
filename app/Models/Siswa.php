<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(TingkatanKelas::class, 'id_tingkatan_kelas', 'id');
    }

    public function absensi() {
        return $this->hasOne(Absensi::class);
    }

    public function absensis() {
        return $this->hasMany(Absensi::class);
    }
}
