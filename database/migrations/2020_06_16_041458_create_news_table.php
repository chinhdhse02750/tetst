<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content')->comment('News content');
            $table->boolean('active')->default(false)->comment('Active flag')->index();
            $table->integer('order')->default(0)->comment('News order');
            $table->string('direction', 100)->default('left')->comment('News direction');
            $table->timestamp('start_time')->nullable()->comment('Start time');
            $table->timestamp('end_time')->nullable()->comment('End time');
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
        Schema::dropIfExists('news');
    }
}
