<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusOnKuis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->string('status');
            $table->string('jenis_kuis');
            $table->string('keterangan');
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
            $table->dropColumn('status');
            $table->dropColumn('jenis_kuis');
            $table->dropColumn('keterangan');
        });
    }
}
