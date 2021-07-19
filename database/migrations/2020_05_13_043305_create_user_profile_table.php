<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pref_id');
            $table->foreign('pref_id')->references('id')->on('pref')->onDelete('cascade');
            $table->string('full_name', 256)->nullable();
            $table->string('facebook', 256)->nullable();
            $table->string('address', 256)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 150);
            $table->integer('time_shipping');
            $table->timestamps();
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
        Schema::dropIfExists('user_profiles');
    }
}
