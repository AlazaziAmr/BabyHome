<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNationalIdMastersTable extends Migration
{
    public function up()
    {
        Schema::table('masters', function (Blueprint $table) {
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masters', function (Blueprint $table) {
            $table->dropColumn('nationality_id');
        });
    }
}
