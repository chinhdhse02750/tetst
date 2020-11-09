<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->comment('Media name');
            $table->string('thumbnail_name', 255)->nullable()->comment('Media thumbnail name');
            $table->string('type', 255)->nullable()->comment('Media type');
            $table->string('path', 255)->nullable()->comment('Media path');
            $table->string('size', 255)->nullable()->comment('Media size');
            $table->string('thumbnail_size', 255)->nullable()->comment('Media thumbnail size');
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
        Schema::dropIfExists('medias');
    }
}
