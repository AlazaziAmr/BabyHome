<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('gender_id')->constrained('genders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('relation_id')->constrained('relations')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date_of_birth');
            $table->text('description');
            $table->boolean('has_disability');
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
        Schema::dropIfExists('children');
    }
}
