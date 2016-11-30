<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryTree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function(Blueprint $table) {
          $table->integer('lft')->default(0);
          $table->integer('rgt')->default(0);
          $table->integer('depth')->default(0);
          $table->integer('parent_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('categories', function(Blueprint $table) {
        $table->dropColumn('lft');
        $table->dropColumn('rgt');
        $table->dropColumn('depth');
        $table->dropColumn('parent_id');
      });
    }
}
