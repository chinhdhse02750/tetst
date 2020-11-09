<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteDefaultOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->datetime('desired_option_1')->default(null)->change();
            $table->datetime('desired_option_2')->default(null)->change();
            $table->datetime('desired_option_3')->default(null)->change();
            $table->datetime('desired_option_4')->default(null)->change();
            $table->datetime('desired_option_5')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
