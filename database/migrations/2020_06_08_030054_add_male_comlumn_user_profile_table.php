<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaleComlumnUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->tinyInteger('male_age')->after('age')->default(0)->comment('年齢 (Male)');
            $table->string('dating_type', 20)->nullable()->default(false)->comment('(交際タイプ) dating type')->change();
            $table->string('favorite_dating_type', 20)->after('dating_type')->nullable()->default(0)->comment('(好きの交際タイプ) Favorite dating type');
            $table->tinyInteger('male_smoking')->after('smoking')->default(0)->comment('喫煙 (Male)');
            $table->smallInteger('alcohol')->default(0)->comment('0: No , 1 : Yes (お酒 (Female))')->change();
            $table->string('male_alcohol', 255)->after('alcohol')->nullable()->comment('お酒 (Male)');
            $table->dateTime('birthday')->after('club_comment')->nullable()->comment('生年月日 (male)');
        });

    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('male_age');
            $table->string('dating_type', 20)->default('A')->comment('dating type')->change();
            $table->dropColumn('favorite_dating_type');
            $table->dropColumn('male_smoking');
            $table->string('alcohol',255)->nullable()->comment('alcohol')->change();
            $table->dropColumn('male_alcohol');
            $table->dropColumn('birthday');
        });
    }
}
