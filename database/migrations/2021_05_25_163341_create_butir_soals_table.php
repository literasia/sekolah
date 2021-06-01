<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateButirSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('butir_soals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('soal_id');
            $table->string('jenis_soal');
            $table->string('pertanyaan');
            $table->string('jawaban')->nullable();
            $table->string('kunci_jawaban')->nullable();
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
        Schema::dropIfExists('butir_soals');
    }
}
