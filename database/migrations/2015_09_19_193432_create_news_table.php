<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
                $table->increments('id');
                $table->string('slug')->nullable();
                $table->string('thumbnail')->nullable();
                $table->string('title');
                $table->string('short_text')->nullable();
                $table->text('text')->nullable();
                $table->text('gallery')->nullable();
                $table->boolean('pin', false);
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
        Schema::drop('news');
    }
}
