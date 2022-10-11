<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingStatus extends Migration
{

    public function up()
    {
        Schema::create('booking_status', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_status');
    }
}
