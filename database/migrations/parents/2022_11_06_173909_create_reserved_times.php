<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservedTimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved_times', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');
            $table->time('start_hour');
            $table->time('end_hour');
            $table->integer('num_of_confirmed_res');
            $table->integer('num_of_unconfirmed_res');
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
        Schema::table('reserved_times', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
