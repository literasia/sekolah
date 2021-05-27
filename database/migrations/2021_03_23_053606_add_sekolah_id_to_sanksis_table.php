<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSekolahIdToSanksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::table('sanksis', function (Blueprint $table) {
            $table->bigInteger('sekolah_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sanksis', function (Blueprint $table) {
            //
        });
    }
}
