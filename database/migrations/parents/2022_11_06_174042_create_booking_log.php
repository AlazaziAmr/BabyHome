<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('booking_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('user_type');
            $table->bigInteger('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('status_id')->constrained('booking_status')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('booking_logs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
