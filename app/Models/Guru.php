<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Guru extends Model
{
    protected $fillable = ['nama', 'status_guru', 'is_aktif', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
