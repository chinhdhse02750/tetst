<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('uuid',50)->unique()->after('id')->comment('uuid');
            $table->integer('type')->after('email')->default(0)->comment('0:Female  1:Male');
            $table->timestamp('password_changed_at')->nullable()->after('password')->comment('password change at');
            $table->boolean('active')->after('password_changed_at')->default(false)->comment('false:Not active True:active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
        */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('type');
            $table->dropColumn('password_changed_at');
            $table->dropColumn('active');
        });

    }
}
