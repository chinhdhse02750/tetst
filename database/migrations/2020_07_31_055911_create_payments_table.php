<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->string('transaction_id', 50)->nullable()->comment('transaction ID');
            $table->string('transaction_type', 50)->nullable()->comment('transaction type');
            $table->string('payment_type', 50)->nullable()->comment('payment type');
            $table->integer('payment_amount')->nullable()->comment('payment amount');
            $table->integer('payment_fee')->nullable()->comment('payment fee');
            $table->integer('payment_tax' )->nullable()->comment('payment tax');
            $table->string('currency_code',50 )->nullable()->comment('currency code');
            $table->string('exchange_rate',50)->nullable()->comment('exchange rate with USD');
            $table->string('payment_status', 50 )->nullable()->comment('payment status');
            $table->string('pending_reason', 50 )->nullable()->comment('pending  reason');
            $table->string('reason_code',50)->nullable()->comment('reason code');
            $table->string('seller_paypal_account',50)->nullable()->comment('paypal account');
            $table->string('seller_paypal_ack',50)->nullable()->comment('Acknowledge');
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
        Schema::dropIfExists('payments');
    }
}
