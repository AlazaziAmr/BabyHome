<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildAlertsTable extends Migration
{
    public function up()
    {
        Schema::create('child_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onUpdate('cascade')->onDelete('cascade');
            $table->string('alert_title');
            $table->string('alert_description');
            $table->time('alert_time');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('child_alerts');
    }
}
