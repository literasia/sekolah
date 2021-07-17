<?php

namespace App\Models\Admin;
use App\Models\Admin\Forum;
use App\User;

use Illuminate\Database\Eloquent\Model;

class BalasanForum extends Model
{
    protected $guarded = ['id'];

    public function forum(){
        return $this->belongsTo(Forum::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
