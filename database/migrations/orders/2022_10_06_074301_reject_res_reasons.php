<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RejectResReasons extends Migration
{
    public function up()
    {
        Schema::create('reject_res_reasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking')->onUpdate('cascade')->onDelete('cascade');
            $table->json('reason');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reject_res_reasons');
    }
}
