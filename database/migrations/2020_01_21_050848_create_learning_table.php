<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('message');
            $table->integer('total_learning_length');
            $table->integer('skills')->nullable();
            $table->integer('tasks')->nullable();
            $table->integer('learning_points')->nullable();
            $table->integer('design_points')->nullable();
            $table->integer('developing_points')->nullable();
            $table->integer('debugging_points')->nullable();
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
        Schema::dropIfExists('learning');
    }
}
