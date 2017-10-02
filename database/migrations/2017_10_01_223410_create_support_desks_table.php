<?php

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
            $table->integer('author_id');
            $table->integer('assignee_id');
            $table->integer('category_id');
            $table->integer('status_id');
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
        Schema::dropIfExists('support_desks');
    }
}
