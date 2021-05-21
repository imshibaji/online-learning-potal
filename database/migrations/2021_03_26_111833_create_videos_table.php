<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('image_path');
            $table->string('video_path');
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('caconical')->nullable();
            $table->text('details')->nullable();
            $table->string('status', 10)->default('free');
            $table->nullableMorphs('videoable');
            $table->integer('user_id')->nullable();
            $table->integer('catagory_id')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->string('type', 10)->default('draft');
            $table->boolean('approved')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
