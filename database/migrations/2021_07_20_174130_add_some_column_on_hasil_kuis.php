<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnOnHasilKuis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_kuis', function (Blueprint $table) {
            $table->string('semester')->nullable();
            $table->string('tahun_ajaran')->nullable();
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
            $table->dropColumn('semester');
            $table->dropColumn('tahun_ajaran');
        });
    }
}
