<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sekolah_id');
            $table->string('title');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('start_clock');
            $table->string('end_clock');
            $table->string('prioritas')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('kalenders');
    }
}
