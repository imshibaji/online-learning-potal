<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_charts', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->integer('design');
            $table->integer('develop');
            $table->integer('debug');

            $table->integer('user_id')->nullable();
            $table->integer('learning_id')->nullable();
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
        Schema::dropIfExists('user_charts');
    }
}
