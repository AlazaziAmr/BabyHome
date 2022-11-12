<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('confirmed_bookings_id')->constrained('confirmed_bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('transaction_id')->constrained('transaction_types')->onUpdate('cascade')->onDelete('cascade');
            $table->double('total_payment');
            $table->string('from_account',191);
            $table->string('to_account',191);
            $table->date('date');
            $table->string('notes',191);
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

    }
}
