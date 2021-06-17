<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_siswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kuis_id');
            $table->unsignedBigInteger('butir_soal_id');
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('kuis_id')->references('id')->on('kuis')->onDelete('cascade');
            $table->foreign('butir_soal_id')->references('id')->on('butir_soals')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->string('jawaban');
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
        Schema::dropIfExists('jawaban_siswas');
    }
}
