<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('media_id');
            $table->foreign('media_id')->references('id')->on('medias')->onDelete('cascade');
            $table->boolean('active')->default(false)->comment('Active flag');
            $table->string('redirect_url', 255)->nullable()->comment('Redirect url');
            $table->integer('order')->unsigned()->default(0)->comment('Banner order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
