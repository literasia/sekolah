<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Access extends Model
{
    protected $guarded = ['id'];

    public function pegawai()
    {
    	return $this->belongsTo(Pegawai::class);
    }
}
