<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('confirmed_bookings_id')->constrained('confirmed_bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('transaction_id')->constrained('transaction_types')->onUpdate('cascade')->onDelete('cascade');
            $table->double('total_payment');
            $table->string('from_account');
            $table->string('to_account');
            $table->date('date');
            $table->string('notes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
