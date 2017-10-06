<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSupportDesksTable
 */
class CreateSupportDesksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_desks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('assignee_id')->unsigned();
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statusses');

            $table->integer('priority_id')->unsigned();
            $table->foreign('priority_id')->references('id')->on('priorities');

            $table->string('subject');
            $table->text('description');
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
        Schema::dropIfExists('support_desks');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
