<?php

namespace App\Models\Superadmin;

use App\Models\Pinjam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{ //
    use SoftDeletes;

    protected $guarded = [];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
    
    public function pinjams() {
        return $this->hasMany(Pinjam::class);
    }

    public function subKategori(){
        return $this->belongsTo(SubKategori::class);
    }

    public function tingkat(){
        return $this->belongsTo(Tingkat::class);
    }
}
