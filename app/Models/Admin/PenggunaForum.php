<?php

namespace App\Models\Admin;
use App\User;
use App\Models\Admin\Kelas;

use Illuminate\Database\Eloquent\Model;

class PenggunaForum extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
