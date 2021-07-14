<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSekolahIdOnPenggunaForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengguna_forums', function (Blueprint $table) {
            $table->bigInteger('sekolah_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengguna_forums', function (Blueprint $table) {
            $table->dropColumn('sekolah_id');
        });
    }
}
