<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('soal_id');
            $table->unsignedBigInteger('kuis_id');
            $table->unsignedBigInteger('pengaturan_kuis_id');
            $table->unsignedBigInteger('sekolah_id');
            $table->integer('durasi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->foreign('soal_id')->references('id')->on('soals')->onDelete('cascade');
            $table->foreign('kuis_id')->references('id')->on('kuis')->onDelete('cascade');
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
        Schema::dropIfExists('kuis');
    }
}
