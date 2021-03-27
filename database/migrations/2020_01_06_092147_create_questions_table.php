<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('topic_id');
            $table->text('question');
            $table->smallInteger('qtype');
            $table->json('opt');
            $table->json('ans');
            $table->text('answer')->nullable();
            $table->smallInteger('design_points')->nullable();
            $table->smallInteger('development_points')->nullable();
            $table->smallInteger('debugging_points')->nullable();
            $table->json('duration')->nullable();
            $table->string('status', 10);
            $table->integer('short')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('questions');
    }
}
