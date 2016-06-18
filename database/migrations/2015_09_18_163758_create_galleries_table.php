<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::create('galleries', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title')->nullable();
        //     $table->string('subtitle')->nullable();
        //     $table->text('description')->nullable();
        //     $table->text('images')->nullable();
        //     $table->text('videos')->nullable();
        //     $table->string('tag')->nullable();
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
        //
        // Schema::drop('galleries');
    }
}
