<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAccessLevelOnPengaturanForums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaturan_forums', function (Blueprint $table) {
            $table->enum('access_level', ['keymaster', 'moderator', 'peserta', 'blokir_pengguna'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaturan_forums', function (Blueprint $table) {
            $table->dropColumn('access_level');
        });
    }
}
