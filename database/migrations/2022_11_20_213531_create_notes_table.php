<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('notes');
            $table->foreignId('master_id')->nullable()->constrained('masters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('nursery_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('child_id');
            $table->foreignId('status')->nullable();
            $table->integer('user_type')->nullable();
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
        Schema::dropIfExists('notes');
    }
}
