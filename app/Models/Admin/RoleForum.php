<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoleForum extends Model
{
    protected $guarded = ['id'];

    public function penggunaForum(){
        return $this->belongsToMany(PenggunaForum::class);
    }
}
