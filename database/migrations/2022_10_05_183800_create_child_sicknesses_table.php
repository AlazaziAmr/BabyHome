<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildSicknessesTable extends Migration
{
    public function up()
    {
        Schema::create('child_sicknesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onUpdate('cascade')->onDelete('cascade');
            $table->string('sickness_name');
            $table->date('sickness_date')->nullable();
            $table->string('sickness_desc');
            $table->tinyInteger('sickness_status')->comment('1 danger - 2 medium - 3 simple');
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
        Schema::dropIfExists('child_sicknesses');
    }
}
