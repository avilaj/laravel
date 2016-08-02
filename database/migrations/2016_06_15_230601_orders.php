<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->references('id')->on('users');
            $table->string('details')->nullable();
            $table->string('status')->nullable();
            $table->float('price')->default(0);
            $table->timestamps();
        });
        Schema::create('order_reference', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->references('id')->on('orders');
            $table->integer('reference_id')->references('id')->on('references');
            $table->integer('size_id')->references('id')->on('sizes');
            $table->integer('product_id')->references('id')->on('products');
            $table->integer('qty')->default(0);
            $table->float('price')->default(0);
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
        Schema::drop('orders');
        Schema::drop('order_reference');
    }
}
