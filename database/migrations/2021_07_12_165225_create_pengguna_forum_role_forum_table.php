<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaForumRoleForumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna_forum_role_forum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_forum_id');
            $table->unsignedBigInteger('pengguna_forum_id');
            $table->foreign('role_forum_id')->references('id')->on('role_forums')->onDelete('cascade');
            $table->foreign('pengguna_forum_id')->references('id')->on('pengguna_forums')->onDelete('cascade');
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
        Schema::dropIfExists('pengguna_forum_role_forum');
    }
}
