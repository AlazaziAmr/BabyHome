<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('system_accounts', function (Blueprint $table) {
               $table->id();
               $table->string('account_name',191);
               $table->string('account_number',191);
               $table->double('balance');
               $table->softDeletes();
               $table->timestamps();
           });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_accounts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
