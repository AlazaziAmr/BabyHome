<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->text('description');
            $table->string('unit')->nullable();
            $table->decimal('price')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_active')->default(1);
            $table->foreignId('type_id')->constrained('nursery_service_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('activities');
    }
}
