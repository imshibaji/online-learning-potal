<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstaMojoPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insta_mojo_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('buyer_name');
            $table->string('email');
            $table->string('phone');
            $table->string('purpose');
            $table->string('amount');
            $table->dateTime('expires_at')->nullable();
            $table->string('sms_status')->nullable();
            $table->string('email_status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('shorturl')->nullable();
            $table->string('longurl')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('allow_repeated_payments')->nullable();
            $table->json('payments')->nullable();

            // Our Data
            $table->integer('user_id')->nullable();
            $table->integer('course_id')->nullable();
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
        Schema::dropIfExists('insta_mojo_payments');
    }
}
