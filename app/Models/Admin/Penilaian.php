<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\CbtButirSoal;

class Penilaian extends Model
{
    protected $guarded = ['id'];

    public function butirSoal(){
        return $this->hasMany(CbtButirSoal::class);
    }
}
