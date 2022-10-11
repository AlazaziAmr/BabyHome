<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameChildrenPhonesTable extends Migration
{
    public function up()
    {
        Schema::table('children_phones', function (Blueprint $table) {
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('children_phones', function (Blueprint $table) {
            Schema::dropColumn('name');
        });
    }
}
