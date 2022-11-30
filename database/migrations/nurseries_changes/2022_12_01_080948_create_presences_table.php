<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('master_id')->constrained('masters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('day')->constrained('days')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('check')->default(0);
            $table->time('from_hour');
            $table->time('to_hour');
            $table->date('date');
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
        Schema::dropIfExists('babysitter_infos');
    }
}
