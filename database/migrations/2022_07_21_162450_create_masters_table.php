<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('name');
            $table->json('first_name')->nullable();
            $table->json('last_name')->nullable();
            $table->json('gender')->nullable();
            $table->string('card_expiration_date')->nullable();
            $table->string('email', 191)->unique()->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('national_id')->unique()->nullable();
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('preferred_language')->default('ar');
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_active')->default(1);
            $table->string('activation_code')->nullable();
            $table->string('reset_password_code')->nullable();
            $table->string('fcm_token')->nullable();
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
        Schema::dropIfExists('masters');
    }
}
