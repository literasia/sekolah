<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumPengaturanOnUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujians', function (Blueprint $table) {
            $table->unsignedBigInteger('pengaturan_kuis_id');
            $table->foreign('pengaturan_kuis_id')->references('id')->on('cbt_pengaturans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ujians', function (Blueprint $table) {
            $table->dropForeign(['pengaturan_kuis_id']);
            $table->dropColumn('pengaturan_kuis_id');
        });
    }
}
