<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('alias', 120)->index();
            $table->integer('parent')->default(0);
            $table->integer('top')->nullable()->default(0);
            $table->tinyInteger('status')->default(0);
            $table->integer('sort')->default(0);
            $table->string('title', 200)->nullable();
            $table->string('keyword', 200)->nullable();
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
        Schema::dropIfExists('categories');
    }
}
