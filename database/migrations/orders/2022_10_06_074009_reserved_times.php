<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReservedTimes extends Migration
{
    public function up()
    {
        Schema::create('reserved_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->time('start_hour');
            $table->time('end_hour');
            $table->integer('num_of_confirmed_res');
            $table->integer('num_of_unconfirmed_res');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reserved_times');

    }
}
