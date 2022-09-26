<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionResultDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_result_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_result_id')->constrained('inspection_results')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('criteria');
            $table->tinyInteger('rating');
            $table->tinyInteger('matching');
            $table->tinyInteger('recommendation');
            $table->text('comment');
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
        Schema::dropIfExists('inspection_result_details');
    }
}
