<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('username')->unique();
            $table->string('profile_picture')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('mobile',15)->nullable();
            $table->string('whatsapp',20)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('type', 10)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('premium_status', 10)->nullable();
            $table->boolean('toc')->default(false);
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
        Schema::dropIfExists('teachers');
    }
}
