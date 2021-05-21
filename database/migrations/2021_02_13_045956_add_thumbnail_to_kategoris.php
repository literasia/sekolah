<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailToKategoris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //
    public function up()
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->string('thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategoris', function (Blueprint $table) {
            //
        });
    }
}
