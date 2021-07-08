<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    protected $guarded = ['id'];

    public function kuis(){
        return $this->belongsTo(Kuis::class);
    }
}
