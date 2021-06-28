<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumSekolahIdOnBankSoals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_soals', function (Blueprint $table) {
            $table->dropForeign(['sekolah_id']);
            $table->dropColumn('sekolah_id');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_soals',function(Blueprint $table){
            $table->unsignedBigInteger('sekolah_id');
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
        });
    }
}
