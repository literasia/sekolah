<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturanForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_forums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('permission_access_level')->default(0);
            $table->integer('permission_posting_limit')->default(0);
            $table->integer('posting_limit_time');
            $table->integer('permission_edit_content')->default(1);
            $table->integer('edit_limit_time');
            $table->integer('permission_guest_account')->default(0);
            $table->integer('auto_embeded_link')->default(1);
            $table->integer('permission_reply_thread')->default(0);
            $table->enum('amount_reply_thread', ['2','3','4','5','6']);
            $table->integer('permission_revisions')->default(1);
            $table->integer('permission_topic_favorit')->default(1);
            $table->integer('permission_search')->default(1);
            $table->integer('permission_post_formating')->default(0);
            $table->integer('permission_forum_moderator')->default(0);
            $table->integer('permission_super_moderator')->default(0);
            $table->integer('amount_page_topic');
            $table->integer('amount_page_reply');
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
        Schema::dropIfExists('pengaturan_forums');
    }
}
