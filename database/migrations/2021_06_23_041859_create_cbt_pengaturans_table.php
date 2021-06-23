<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCbtPengaturansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cbt_pengaturans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sekolah_id');
            $table->integer('is_hide_title')->default(0);
            $table->integer('restart_quiz')->default(0);
            $table->integer('random_question')->default(0);
            $table->integer('random_option')->default(0);
            $table->integer('statistic')->default(0);
            $table->integer('take_quiz_only_once')->default(0);
            $table->integer('only_show_specific_question')->default(0);
            $table->integer('many_questions_should_be_displayed')->default(0);
            $table->integer('skip_question')->default(0);
            $table->integer('autostart')->default(0);
            $table->integer('only_registered')->default(0);
            $table->integer('show_point')->default(0);
            $table->integer('with_number_in_option')->default(0);
            $table->integer('show_correct_option')->default(0);
            $table->integer('answer_mark')->default(0);
            $table->integer('force_answer')->default(0);
            $table->integer('hide_numbering')->default(0);
            $table->integer('show_average_point')->default(0);
            $table->integer('hide_correct_question')->default(0);
            $table->integer('hide_quiz_time')->default(0);
            $table->integer('hide_quiz_score')->default(0);
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->onDelete('cascade');
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
        Schema::dropIfExists('cbt_pengaturans');
    }
}
