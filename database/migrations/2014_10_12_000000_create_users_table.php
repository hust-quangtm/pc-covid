<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->string('address')->nullable(); //Địa chỉ (nơi ở hiện tại)
            $table->string('identify_number')->nullable(); //Số CMT
            $table->string('home_town')->nullable();
            $table->string('residence')->nullable(); //Nơi thường trú
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->string('password');
            $table->string('note')->nullable();
            $table->string('card_front')->nullable();
            $table->string('card_back')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
