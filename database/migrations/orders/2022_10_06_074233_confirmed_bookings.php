<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfirmedBookings extends Migration
{
    public function up()
    {
        Schema::create('confirmed_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('booking')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->date('confirm_date')->nullable();
            $table->double('total_payment');
            $table->double('price_per_hour');
            $table->double('total_services_price');
            $table->bigInteger('created_by');
            $table->tinyInteger('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('confirmed_bookings');
    }
}
