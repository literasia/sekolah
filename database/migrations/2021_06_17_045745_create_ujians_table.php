<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('soal_id');
            $table->unsignedBigInteger('pengaturan_kuis_id');
            $table->unsignedBigInteger('sekolah_id');
            $table->integer('durasi');
            $table->string('kuis');
            $table->string('status');
            $table->string('jenis_kuis');
            $table->text('keterangan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->foreign('soal_id')->references('id')->on('cbt_soals')->onDelete('cascade');
            $table->foreign('pengaturan_kuis_id')->references('id')->on('pengaturan_kuis')->onDelete('cascade');
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
        Schema::dropIfExists('ujians');
    }
}
