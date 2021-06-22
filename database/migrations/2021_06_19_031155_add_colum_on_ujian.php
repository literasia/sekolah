<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumOnUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujians', function (Blueprint $table) {
            $table->integer('jumlah_soal_pg');
            $table->integer('jumlah_soal_essai');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->date('tanggal_terbit');
            $table->time('jam_terbit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
