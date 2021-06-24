<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Guru, MataPelajaran};
use App\Models\Admin\Kelas;

class Materi extends Model
{
    protected $guarded = ['id'];

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
