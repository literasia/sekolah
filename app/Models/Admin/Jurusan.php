<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Jurusan extends Model
{ //
    use SoftDeletes;
    protected $fillable = [
        'kode', 'name', 'user_id'
    ];
    protected $table = "jurusans";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
