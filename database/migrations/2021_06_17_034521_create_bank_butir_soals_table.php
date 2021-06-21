<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankButirSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_butir_soals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('soal_id');
            $table->string('jenis_soal');
            $table->string('pertanyaan');
            $table->string('jawaban')->nullable();
            $table->string('kunci_jawaban')->nullable();
            $table->integer('poin');
            $table->foreign('soal_id')->references('id')->on('bank_soals')->onDelete('cascade');
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
        Schema::dropIfExists('bank_butir_soals');
    }
}
