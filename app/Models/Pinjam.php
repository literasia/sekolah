<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    //
    protected $fillable = [
        'siswa_id', 'library_id', 'ebook_expired_at', 'audio_expired_at', 'video_expired_at', 'total_pinjam'
    ];
}
