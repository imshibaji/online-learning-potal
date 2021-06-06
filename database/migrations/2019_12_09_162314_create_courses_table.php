<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('catagory_id');
            $table->string('title', 191);
            $table->string('slag', 191);
            $table->text('details')->nullable();
            $table->string('meta_keys')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('caconical')->nullable();
            $table->string('duration')->nullable();
            $table->integer('short')->nullable();
            $table->string('status', 10);
            $table->string('accessible', 10);
            $table->float('actual_price')->nullable();
            $table->float('offer_price')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('manager_user_id')->nullable();
            $table->string('embed_code')->nullable();
            $table->string('image_path')->nullable();
            $table->string('language')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
