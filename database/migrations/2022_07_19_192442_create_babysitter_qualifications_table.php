<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBabysitterQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('babysitter_qualifications', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignId('qualification_id')->constrained('qualifications')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('babysitter_id')->constrained('babysitter_infos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('babysitter_qualifications');
    }
}
