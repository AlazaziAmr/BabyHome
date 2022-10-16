<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildAllargisTable extends Migration
{
    public function up()
    {
        Schema::create('child_allergies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onUpdate('cascade')->onDelete('cascade');
            $table->string('allergy_name');
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
        Schema::dropIfExists('child_allergies');
    }

}
