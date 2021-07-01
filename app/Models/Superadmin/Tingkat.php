<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tingkat extends Model
{ //
    use SoftDeletes;
    
    protected $guarded = [];

    public function library(){
        return $this->hasMany(Library::class);
    }

    public function bankSoal(){
        return $this->hasMany(BankSoal::class);
    }
}
