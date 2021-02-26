<?php

namespace App\Models\Superadmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Berita extends Model
{
    use SoftDeletes;

    protected $table = 'beritas';
	protected $fillable = [
        'name', 'kategori', 'isi', 'thumbnail'
    ];
    protected $guarded = [];
}