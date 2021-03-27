<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('details')->nullable();
            $table->dateTime('sending_time')->default(now());
            $table->dateTime('expaire_at')->nullable();
            $table->enum('sending_status', ['yes', 'no'])->default('no');
            $table->enum('notify_type', ['all', 'sms', 'email', 'whatsapp', 'dashboard'])->default('all');
            $table->enum('premium_type', ['none', 'silver', 'gold', 'platinum'])->default('none');
            $table->enum('user_type', ['all', 'user', 'admin', 'stuff'])->default('all');
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
