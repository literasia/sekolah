<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = ['nama', 'status_guru', 'is_aktif', 'foto', 'user_id'];
}
