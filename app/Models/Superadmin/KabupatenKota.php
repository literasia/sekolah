<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KabupatenKota extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function provinsi() {
        return $this->belongsTo('App\Models\Superadmin\Provinsi');
    }
}
