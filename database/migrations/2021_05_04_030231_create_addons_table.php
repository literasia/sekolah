<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sekolah_id');
            $table->integer('referensi');
            $table->integer('sekolah');
            $table->integer('fungsionaris');
            $table->integer('pelajaran');
            $table->integer('peserta_didik');
            $table->integer('absensi');
            $table->integer('e_learning');
            $table->integer('daftar_nilai');
            $table->integer('e_rapor');
            $table->integer('pelanggaran');
            $table->integer('e_voting');
            $table->integer('kalender');
            $table->integer('import');
            $table->integer('perpustakaan');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
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
        Schema::dropIfExists('addons');
    }
}
