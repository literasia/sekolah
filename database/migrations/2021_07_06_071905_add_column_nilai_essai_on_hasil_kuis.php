<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNilaiEssaiOnHasilKuis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_kuis', function (Blueprint $table) {
            $table->integer('nilai_essai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_kuis', function (Blueprint $table) {
            $table->dropColumn('nilai_essai');
        });
    }
}
