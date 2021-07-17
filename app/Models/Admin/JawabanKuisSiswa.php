<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class JawabanKuisSiswa extends Model
{
    protected $guarded = ['id'];

    public function butirSoal(){
        return $this->belongsTo(ButirSoal::class);
    }
}
