<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}