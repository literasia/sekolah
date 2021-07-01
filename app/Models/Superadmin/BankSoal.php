<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;
use App\Models\Superadmin\Kelas;
use App\Models\Superadmin\Kuis;
use App\Models\Superadmin\BankButirSoal;

class BankSoal extends Model
{
    protected $guarded = ['id'];

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class);
    }

    public function butirSoal(){
        return $this->hasMany(BankButirSoal::class);
    }

    public function tingkat(){
        return $this->belongsTo(Tingkat::class);
    }
}
