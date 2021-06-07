<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnOnKuis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->integer('jumlah_soal_pg');
            $table->integer('jumlah_soal_essai');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->dropColumn('jumlah_soal_pg');
            $table->dropColumn('jumlah_soal_essai');
            $table->dropColumn('jumlah_soal');
            $table->dropColumn('jumlah_selesai');
        });
    }
}
