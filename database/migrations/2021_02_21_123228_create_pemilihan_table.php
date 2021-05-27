<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemilihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::create('pemilihan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sekolah_id')->unsigned()->nullable();
            $table->string('posisi');
            $table->string('start_date');
            $table->string('end_date');
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
        Schema::dropIfExists('pemilihan');
    }
}
