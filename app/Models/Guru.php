<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Pegawai;
use App\Models\{JadwalPelajaran, MataPelajaran};
use App\Models\Admin\Materi;

class Guru extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }

    public function jadwalPelajaran() {
    	return $this->hasManyThrough(JadwalPelajaran::class, MataPelajaran::class);
    }

    public function jamPelajaran() {
        return $this->hasManyThrough(jamPelajaran::class);
    }

    public function mataPelajaran(){
        return $this->hasMany(MataPelajaran::class);
    }

    public function statusGuru(){
        return $this->belongsTo(StatusGuru::class);
    }

    public function materi(){
        return $this->hasMany(Materi::class);
    }
}
