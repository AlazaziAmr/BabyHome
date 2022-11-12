<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('master_id')->constrained('master_accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('child_id')->constrained('children')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('status_id')->constrained('booking_status')->onUpdate('cascade')->onDelete('cascade');
            $table->date('booking_date');
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime');
            $table->integer('total_hours');
            $table->bigInteger('created_by');
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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
