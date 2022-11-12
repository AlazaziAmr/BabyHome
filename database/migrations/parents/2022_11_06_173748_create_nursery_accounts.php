<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseryAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('nursery_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nursery_id')->constrained('nurseries')->onUpdate('cascade')->onDelete('cascade');
            $table->string('account_number',191);
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
        Schema::table('nursery_accounts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
