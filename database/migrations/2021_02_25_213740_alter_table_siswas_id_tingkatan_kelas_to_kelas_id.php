<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSiswasIdTingkatanKelasToKelasId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign('siswas_id_tingkatan_kelas_foreign');
            $table->dropColumn('id_tingkatan_kelas');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->renameColumn('id_tingkatan_kelas', 'kelas_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            //
        });
    }
}
