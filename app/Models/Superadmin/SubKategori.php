<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Superadmin\Kategori;

class SubKategori extends Model
{
    protected $guarded = [];
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function library(){
        return $this->hasMany(Library::class);
    }
}
