<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIndexUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->listTableDetails('user_profiles');

            if ($doctrineTable->hasIndex('search')) {
                DB::statement('ALTER TABLE user_profiles DROP INDEX search');
            }

            DB::statement('ALTER TABLE user_profiles ADD FULLTEXT `search`(`name`, `comment`, `club_comment`)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function($table) {
            $table->dropIndex('search');
        });
    }
}
