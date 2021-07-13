<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditBalasanIdFromBalasanForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balasan_forums', function (Blueprint $table) {
            $table->bigInteger('balasan_id')->nullable()->change();
            $table->bigInteger('sekolah_id')->after('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balasan_forums', function (Blueprint $table) {
            $table->dropColumn('balasan_id');
            $table->dropColumn('sekolah_id');
        });
    }
}
