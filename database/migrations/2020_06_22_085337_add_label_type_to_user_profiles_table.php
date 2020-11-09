<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabelTypeToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->integer('label_type')->default(0)->after('is_publish')->comment('Label type');
            $table->string('label_title', 255)->nullable()->after('label_type')->comment('Label title');
            $table->string('label_color_code', 100)->nullable()->after('label_title')->comment('Label color code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('label_type');
            $table->dropColumn('label_title');
            $table->dropColumn('label_color_code');
        });
    }
}
