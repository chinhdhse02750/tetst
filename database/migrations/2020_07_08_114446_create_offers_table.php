<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('candidate_setting_option_1')->default(false);
            $table->boolean('candidate_setting_option_2')->default(false);
            $table->timestamp('desired_option_1')->default(false)->comment('date time for option_1');
            $table->timestamp('desired_option_2')->default(false)->nullable()->comment('date time for option_2');
            $table->timestamp('desired_option_3')->default(false)->nullable()->comment('date time for option_3');
            $table->timestamp('desired_option_4')->default(false)->nullable()->comment('date time for option_4');
            $table->timestamp('desired_option_5')->default(false)->nullable()->comment('date time for option_5');
            $table->text('desired_content')->nullable()->comment('meeting Place and other comments');
            $table->string('request_option', 20)->nullable()->comment('request option for user offer');
            $table->text('request_other')->nullable()->comment('request other for user offer');
            $table->text('request_admin')->nullable()->comment('request admin');
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
        Schema::dropIfExists('offers');
    }
}
