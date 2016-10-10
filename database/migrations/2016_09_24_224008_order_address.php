<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->string('city');
          $table->string('state');
          $table->string('postal');
          $table->string('address');
          $table->integer("shipping_area_id")->references("id")->on("shipping_areas");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table) {
          $table->dropColumn('city');
          $table->dropColumn('state');
          $table->dropColumn('postal');
          $table->dropColumn('address');
          $table->dropColumn("shipping_area_id");
        });
    }
}
