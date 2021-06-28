<?php

namespace App\Models;

use App\Http\Controllers\Admin\Sekolah\JamPelajaranController;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    public function mataPelajaran() {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
    
    public function jamPelajaran() {
        return $this->belongsTo(JamPelajaran::class, 'jam_pelajaran');
    }
    
    public function kelas() {
        return $this->belongsTo(Admin\Kelas::class);
    }
     
    public function getHari($hari){
        switch ($hari) {
           case 'Monday':
               return 'senin';
               break;
           case 'Tuesday':
               return 'selasa';
               break;
           case 'Wednesday':
               return 'rabu';
               break;
           case 'Thursday':
               return 'kamis';
               break;
           case 'Friday':
               return 'jumat';
               break; 
           case 'Saturday':
               return 'sabtu';
               break;    
           case 'Sunday':
               return 'minggu';
               break;             
    }
   }
}
