<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBabysitterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('babysitter_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('years_of_experince');
            $table->string('date_of_birth');
            $table->string('national_id')->unique();
            $table->string('nationality');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('free_of_disease');
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
