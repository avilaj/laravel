<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label')->unique();
            $table->timestamps();
        });
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label')->unique();
            $table->timestamps();
        });
        Schema::create('types_size', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->references('id')->on('types');
            $table->integer('size_id')->references('id')->on('sizes');
            $table->timestamps();
        });
        // Schema::create('reference_size', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('reference_id')->references('id')->on('references');
        //     $table->integer('size_id')->references('id')->on('sizes');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sizes');
        Schema::drop('types');
        Schema::drop('types_size');
        // Schema::drop('reference_size');
    }
}
