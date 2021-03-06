<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('gender')->nullable();

            $table->text('description')->nullable();
            $table->text('specs')->nullable();
            $table->text('images')->nullable();

            $table->string('tags')->default('[]');
            $table->float('price')->default(0);
            $table->float('weight')->default(0);
            $table->integer('category_id')->references('id')->on('categories');
            $table->integer('type_id')->references('id')->on('types');
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
        Schema::drop('products');
    }
}
