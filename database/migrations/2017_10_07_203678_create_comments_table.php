<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('message');
            $table->timestamps();
        });

        Schema::create('comments_support_desk', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('support_desk_id')->unsigned();
            $table->foreign('support_desk_id')->references('id')->on('support_desks')->onDelete('cascade');

            $table->integer('comments_id')->unsigned();
            $table->foreign('comments_id')->references('id')->on('comments')->onDelete('cascade');

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('comments_support_desk');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
