<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;
use App\Models\Admin\Kelas;
use App\Models\Admin\Kuis;
use App\Models\Admin\BankButirSoal;

class BankSoal extends Model
{
    protected $guarded = ['id'];


    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class);
    }

    public function butirSoal(){
        return $this->hasMany(BankButirSoal::class);
    }
}
