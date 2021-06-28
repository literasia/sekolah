<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\Materi;
use App\Models\TingkatanKelas;
use App\Models\Pegawai;
use App\Models\Admin\Jurusan;
use App\Models\Admin\Forum;

class Kelas extends Model
{ //
    use SoftDeletes;
    protected $fillable = [
        'name', 'tingkatan_kelas_id', 'pegawai_id', 'jurusan_id', 'kapasitas', 'keterangan', 'user_id'
    ];
    protected $table = "kelas";
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas(){
        return $this->hasMany(Kelas::class);
    }
    
    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }

    public function materi(){
        return $this->hasMany(Materi::class);
    }

    public function tingkatanKelas(){
        return $this->belongsTo(TingkatanKelas::class);
    }
    
    public function jurusan(){
        return $this->belongsTo(Jurusan::class);
    }
    public function penggunaforum(){
        return $this->hasMany(PenggunaForum::class);
    }
}
