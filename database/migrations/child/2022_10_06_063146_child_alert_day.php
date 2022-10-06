<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChildAlertDay extends Migration
{
    public function up()
    {
        Schema::create('child_alert_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alert_id')->constrained('child_alerts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('day_id')->constrained('days')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('child_alert_day');
    }
}
