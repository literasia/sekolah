<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Superadmin\Siswa;

class Ranking extends Model
{
    protected $guarded = ['id'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
}
