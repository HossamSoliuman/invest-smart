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
            $table->id();
            $table->string('name');
            $table->string('user_name')->nullable();
            $table->string('account_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_mail_at')->nullable();
            $table->string('email_verification_code')->nullable();
            $table->integer('email_verification_count')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->integer('balance')->default(0);
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
