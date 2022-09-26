<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('master_id')->constrained('masters')->onUpdate('cascade')->onDelete('cascade');
            $table->date('joining_date');
            $table->boolean('is_approved')->default(0);
            $table->date('approved_at');
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
        Schema::dropIfExists('join_requests');
    }
}
