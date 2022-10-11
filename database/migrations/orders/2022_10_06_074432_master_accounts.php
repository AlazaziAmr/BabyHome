<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterAccounts extends Migration
{
    public function up()
    {
        Schema::create('master_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_id')->constrained('masters')->onUpdate('cascade')->onDelete('cascade');
            $table->string('account_number');
            $table->double('balance');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_accounts');
    }
}
