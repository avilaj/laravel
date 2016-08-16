<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("payments", function (Blueprint $table){
          $table->increments("id");
          $table->float("amount_requested");
          $table->float("amount_paid");
          $table->integer("order_id")->references("id")->on("orders");
          $table->integer("notification_id")->references("id")->on("notifications");
          $table->string("merchant_order");
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
        Schema::drop("payments");
    }
}
