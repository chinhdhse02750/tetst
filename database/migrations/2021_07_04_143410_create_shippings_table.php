<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateShippingsTable.
 */
class CreateShippingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shippings', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pref_id');
            $table->foreign('pref_id')->references('id')->on('pref')->onDelete('cascade');
            $table->integer('price');
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
		Schema::drop('shippings');
	}
}
