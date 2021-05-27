<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Siswa;

class PelanggaranSiswa extends Model
{ //
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $table = "pelanggaran_siswas";

   public function siswa(){
   		return $this->belongsTo(Siswa::class);
   }
}
