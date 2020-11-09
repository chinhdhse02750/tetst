<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->tinyInteger('payment_method')->nullable()->after('request_admin')
                ->comment('0: point , 1: bank transfer , 2: paypal');
            $table->tinyInteger('status')->nullable()->after('payment_method')
                ->comment('0: request , 1: approve , 2: reject');
            $table->text('payment_link')->nullable()->after('status')
                ->comment('link to payment');
            $table->text('reject_message')->nullable()->after('payment_link')
                ->comment('reason for the rejection');
            $table->timestamp('rejected_at')->nullable()->after('reject_message')->comment('reject at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('status');
            $table->dropColumn('reject_message');
            $table->dropColumn('rejected_at');
        });
    }
}
