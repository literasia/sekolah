<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class TingkatanKelas extends Model
{
    use SoftDeletes;

    protected $table = 'tingkatan_kelas';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
