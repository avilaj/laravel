<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('carts', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('customer_id')->references('id')->on('users');
        //     $table->string('details')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
        // Schema::create('carts_reference', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('cart_id')->references('id')->on('carts');
        //     $table->integer('reference_id')->references('id')->on('references');
        //     $table->integer('qty');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('carts');
        // Schema::drop('carts_reference');
    }
}
