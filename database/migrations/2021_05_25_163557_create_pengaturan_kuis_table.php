<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturanKuisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_kuis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sekolah_id');
            $table->integer('is_hide_title')->default(0);
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
        Schema::dropIfExists('pengaturan_kuis');
    }
}
