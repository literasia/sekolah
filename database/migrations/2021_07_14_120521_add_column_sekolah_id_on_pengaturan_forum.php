<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSekolahIdOnPengaturanForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaturan_forums', function (Blueprint $table) {
            $table->unsignedBigInteger('sekolah_id')->nullable();
            $table->foreign('sekolah_id')->on('sekolahs')->references('id')->onDelete('cascade');
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
            $table->dropColumn('sekolah_id');
            $table->dropForeign(['sekolah_id']);
        });
    }
}
