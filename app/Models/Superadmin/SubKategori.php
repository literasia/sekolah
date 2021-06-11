<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Superadmin\Kategori;

class SubKategori extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
