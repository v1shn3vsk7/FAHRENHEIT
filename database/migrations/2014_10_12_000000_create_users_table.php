<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();   
            //$table->id();            

            $table->string('login')->unique();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password', 60);

            $table->date('birthdate');

            $table->string('phone')->unique();
            $table->string('city');
            $table->string('img')->default('avatars/def/avatar.jpg');
            $table->boolean('spam');
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
};
