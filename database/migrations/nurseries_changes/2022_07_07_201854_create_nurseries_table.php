<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseriesTable extends Migration
{
    public function up()
    {
        Schema::create('nurseries', function (Blueprint $table) {
            $table->id();
          /*  New Add*/
            $table->json('name');
            $table->json('first_name');
            $table->json('last_name');
            $table->string('license_no');
            $table->json('gender');
            $table->string('card_expiration_date');
//            $table->string('nationality');
//            $table->string('document')->comment('Pdf or Image');
          /* End New Add*/

            // $table->json('name');
            $table->integer('capacity')->max(3);
            $table->integer('acceptance_age_type')->comment('1 for month - 2 for year');
            $table->integer('acceptance_age_from');
            $table->integer('acceptance_age_to');
            $table->string('national_address');
            $table->text('address_description');
            $table->decimal('price');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('building_type');
            // $table->boolean('disabilities_acceptance');
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('country_id')->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('neighborhood_id')->constrained('neighborhoods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nationality_id')->nullable()->constrained('nationalities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('nurseries');
    }
}
