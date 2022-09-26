<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBabysitterLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('babysitter_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('babysitter_info_id')->constrained('babysitter_infos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('languages')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('babysitter_languages');
    }
}
