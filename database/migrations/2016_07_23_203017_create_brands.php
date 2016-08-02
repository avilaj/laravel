<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
            $table
                ->integer('brand_id')
                ->references('id')
                ->on('brands')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('brands');
        Schema::table('products', function ($table) {
            $table->dropColumn('brand_id');
        });
    }
}
