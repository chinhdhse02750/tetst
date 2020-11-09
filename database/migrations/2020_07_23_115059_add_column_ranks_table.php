<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ranks', function (Blueprint $table) {
            $table->tinyInteger('priority')->default(0)->after('amount');
            $table->string('color_code')->nullable()->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranks', function (Blueprint $table) {
            $table->dropColumn('priority');
            $table->dropColumn('color_code');
        });
    }
}
