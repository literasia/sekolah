<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForeignKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_kategoris', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->foreign('kategori_id')->on('kategoris')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_kategoris', function (Blueprint $table) {
            $table->dropColumn('kategori_id');
            $table->dropForeign(['kategori_id']);
        });
    }
}
