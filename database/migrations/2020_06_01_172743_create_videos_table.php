<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->comment('Video file name');
            $table->string('thumbnail_name', 255)->nullable()->comment('Video thumbnail name');
            $table->string('type', 255)->nullable()->comment('Video type');
            $table->string('path', 255)->nullable()->comment('Video path');
            $table->string('size', 255)->nullable()->comment('Video size');
            $table->string('thumbnail_size', 255)->nullable()->comment('Video thumbnail size');
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
        Schema::dropIfExists('videos');
    }
}
