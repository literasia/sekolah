<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCbtButirSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cbt_butir_soals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('soal_id');
            $table->string('jenis_soal');
            $table->text('pertanyaan');
            $table->text('jawaban')->nullable();
            $table->string('kunci_jawaban')->nullable();
            $table->integer('poin');
            $table->foreign('soal_id')->references('id')->on('cbt_soals')->onDelete('cascade');
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
        Schema::dropIfExists('cbt_butir_soals');
    }
}
