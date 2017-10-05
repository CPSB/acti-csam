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
            $table->integer('author_id')->nullable();
            $table->integer('assignee_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('status_id')->nullable();
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
