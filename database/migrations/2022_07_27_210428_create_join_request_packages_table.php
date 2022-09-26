<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinRequestPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_request_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('join_request_id')->constrained('join_requests')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('package_infos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('join_request_packages');
    }
}
