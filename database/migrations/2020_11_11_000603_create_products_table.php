<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('type_products')->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('cascade');
            $table->string('name', 255)->comment('Type of product name');
            $table->string('description', 300)->nullable();
            $table->text('content')->nullable();
            $table->float('discount_price')->default(0)->nullable();
            $table->string('image', 255);
            $table->integer('brand_id')->nullable()->default(0)->index();
            $table->integer('supplier_id')->nullable()->default(0)->index();
            $table->integer('price')->nullable()->default(0);
            $table->integer('cost')->nullable()->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->integer('sold')->nullable()->default(0);
            $table->tinyInteger('status')->default(0)->index();
            $table->string('alias', 120)->index();
            $table->integer('category_store_id')->default(1)->nullable()->index();
            $table->integer('store_id')->default(1)->index();
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
        Schema::dropIfExists('products');
    }
}
