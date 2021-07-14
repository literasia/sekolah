<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('topik_id');
            $table->unsignedBigInteger('user_id');
            $table->string('judul');
            $table->string('total_balasan');
            $table->enum('privasi', ['publik', 'privasi']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('topik_id')->references('id')->on('topiks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
}
