<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        Schema::create('booking_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nursery_id')->constrained('nursery_accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('service_id')->constrained('payment_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('master_id')->constrained('master_accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('child_id')->constrained('children')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('service_type_id');
            $table->double('service_price');
            $table->integer('service_quantity');
            $table->string('notes',191);
            $table->tinyInteger('status');
            $table->tinyInteger('attended');
            $table->softDeletes();
            $table->timestamps();
        });

        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_services', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
