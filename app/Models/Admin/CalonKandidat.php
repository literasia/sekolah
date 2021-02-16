<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalonKandidat extends Model
{
    use SoftDeletes;

	protected $fillable = [
        'name'
    ];
    protected $guarded = [];
}
