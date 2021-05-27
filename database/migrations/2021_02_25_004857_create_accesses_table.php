<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sekolah_id');
            $table->bigInteger('pegawai_id');
            $table->boolean('kalender')->default('0');
            $table->boolean('sekolah')->default('0');
            $table->boolean('pelajaran')->default('0');
            $table->boolean('peserta_didik')->default('0');
            $table->boolean('absensi')->default('0');
            $table->boolean('daftar_nilai')->default('0');
            $table->boolean('pelanggaran')->default('0');
            $table->boolean('template')->default('0');
            $table->boolean('log_user')->default('0');
            $table->boolean('referensi')->default('0');
            $table->boolean('buku_tamu')->default('0');
            $table->boolean('konsultasi')->default('0');
            $table->boolean('perpustakaan')->default('0');
            $table->boolean('keuangan')->default('0');
            $table->boolean('sarana_prasarana')->default('0');
            $table->boolean('penerimaan_murid_baru')->default('0');
            $table->boolean('ujian_sekolah_berbasis_komputer')->default('0');
            $table->boolean('e_voting')->default('0');
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
        Schema::dropIfExists('accesses');
    }
}
