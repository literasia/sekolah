<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSubKategoriOnLibraries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('libraries', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_kategori_id')->nullable();
            $table->foreign('sub_kategori_id')->references('id')->on('sub_kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('libraries', function (Blueprint $table) {
            $table->dropForeign(['sub_kategori_id']);
            $table->dropColumn('sub_kategori_id');
        });
    }
}
