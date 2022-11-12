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
            $table->string('uid');
            $table->string('name');
            $table->string('email', 191)->unique()->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            // $table->string('national_id')->nullable()->unique();
            $table->string('preferred_language')->default('ar');
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('has_nursery')->default(0);
            $table->boolean('restore_request')->default(0);
            $table->string('activation_code')->nullable();
            $table->string('reset_password_code')->nullable();
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
