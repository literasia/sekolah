<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Superadmin\ReferensiMataPelajaran;
use App\Models\Superadmin\Kelas;
use App\Models\Superadmin\Kuis;
use App\Models\Superadmin\BankButirSoal;
use App\Models\Superadmin\TingkatPendidikan;

class BankSoal extends Model
{
    protected $guarded = ['id'];

    

    public function mataPelajaran(){
        return $this->belongsTo(ReferensiMataPelajaran::class);
    }

    public function bankButirSoal(){
        return $this->hasMany(BankButirSoal::class);
    }

    public function tingkat(){
        return $this->belongsTo(TingkatPendidikan::class);
    }
}
