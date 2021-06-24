<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnOnPengaturanKuis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaturan_kuis', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaturan_kuis', function (Blueprint $table) {
            $table->dropColumn('restart_quiz');
            $table->dropColumn('random_question');
            $table->dropColumn('random_option');
            $table->dropColumn('statistic');
            $table->dropColumn('take_quiz_only_once');
            $table->dropColumn('only_show_specific_question');
            $table->dropColumn('many_questions_should_be_displayed');
            $table->dropColumn('skip_question');
            $table->dropColumn('autostart');
            $table->dropColumn('only_registered');
            $table->dropColumn('show_point');
            $table->dropColumn('with_number_in_option');
            $table->dropColumn('show_correct_option');
            $table->dropColumn('answer_mark');
            $table->dropColumn('force_answer');
            $table->dropColumn('hide_numbering');
            $table->dropColumn('show_average_point');
            $table->dropColumn('hide_correct_question');
            $table->dropColumn('hide_quiz_time');
            $table->dropColumn('hide_quiz_score');
        });
    }
}
