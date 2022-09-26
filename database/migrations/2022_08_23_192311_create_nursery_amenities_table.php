<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseryAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nursery_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('amenity_id')->constrained('amenities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('nursery_amenities');
    }
}
