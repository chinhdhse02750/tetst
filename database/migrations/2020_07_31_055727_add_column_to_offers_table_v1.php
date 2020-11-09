<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOffersTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('payment_link_token', 255)->nullable()
                ->comment('payment_link_token');
            $table->timestamp('payment_link_expired')->nullable()->after('payment_link_token')
                ->comment('payment expired');
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
            $table->dropColumn('payment_link_token');
            $table->dropColumn('payment_link_expired');
        });
    }
}
