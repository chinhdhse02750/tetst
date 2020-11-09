<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameRanksColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ranks', function(Blueprint $table) {
            $table->renameColumn('name', 'name_jp');
            $table->renameColumn('description', 'name_en');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranks', function(Blueprint $table) {
            $table->renameColumn('name_jp', 'name');
            $table->renameColumn('name_en', 'description');
            $table->dropColumn('deleted_at');
        });
    }
}
