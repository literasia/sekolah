<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $guarded = ['id'];

    public function forum(){
        return $this->hasMany(Forum::class);
    }
}
