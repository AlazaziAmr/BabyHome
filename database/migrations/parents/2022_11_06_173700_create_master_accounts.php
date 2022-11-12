<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('master_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_id')->constrained('masters')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('account_number');
            $table->double('balance');
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
        Schema::table('master_accounts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
