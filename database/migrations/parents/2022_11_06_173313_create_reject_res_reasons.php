<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectResReasons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('reject_res_reasons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('reason');
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
        Schema::table('reject_res_reasons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
