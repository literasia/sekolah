<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::create('daftar_nilai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kelas_id');
            $table->bigInteger('siswa_id');
            $table->bigInteger('mata_pelajaran_id');
            $table->bigInteger('semester_id');
            $table->string('tahun_ajaran');
            $table->string('kategori_nilai');
            $table->string('nilai');
            $table->string('urutan_nilai');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_nilai');
    }
}
