<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\BankSoal;

class BankButirSoal extends Model
{
    protected $guarded = ['id'];

    public function soal(){
        return $this->belongsTo(BankSoal::class);
    }
}
