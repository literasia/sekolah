<?php

namespace App\Models\Admin;
use App\User;
use App\Models\Admin\BalasanForum;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $guarded = ['id'];

    public function topik(){
        return $this->belongsTo(Topik::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function balasanforum(){
        return $this->hashMany(BalasanForum::class);
    }

}
