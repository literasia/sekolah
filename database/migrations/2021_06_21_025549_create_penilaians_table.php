<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama');
            $table->integer('poin_jk_benar');
            $table->integer('poin_jk_salah');
            $table->integer('poin_jk_kosong');
            $table->integer('pengali_jk_benar');
            $table->integer('pengali_jk_salah');
            $table->integer('pengali_jk_kosong');
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
        Schema::dropIfExists('penilaians');
    }
}
