<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingLog extends Migration
{
    public function up()
    {
        Schema::create('booking_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->tinyInteger('user_type');
            $table->foreignId('booking_id')->constrained('booking')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('booking_status')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_log');
    }
}
