<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseryEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('nursery_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('inspector_id')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('criteria');
            $table->text('comment');
            $table->double('rating');
            $table->double('lat');
            $table->double('lng');
            $table->tinyInteger('matching');
            $table->tinyInteger('recommendation');
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
        Schema::dropIfExists('nursery_evaluations');
    }
}
