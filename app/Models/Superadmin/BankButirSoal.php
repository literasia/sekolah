<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Superadmin\BankSoal;

class BankButirSoal extends Model
{
    protected $guarded = ['id'];

    public function soal(){
        return $this->belongsTo(BankSoal::class);
    }
}
