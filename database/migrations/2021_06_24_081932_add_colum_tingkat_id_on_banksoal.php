<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumTingkatIdOnBanksoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_soals', function (Blueprint $table) {
            $table->unsignedBigInteger('tingkat_id');
            $table->foreign('tingkat_id')->references('id')->on('tingkat_pendidikans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_soals', function (Blueprint $table) {
            $table->dropForeign(['tingkat_id']);
            $table->dropColumn('tingkat_id');
        });
    }
}
