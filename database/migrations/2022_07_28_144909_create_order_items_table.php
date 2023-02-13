<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');

            $table->dateTime('date')->nullable()->comment("Purchase Items Date");
            $table->tinyInteger('quantity')->default(0)->comment("Quantity");
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('sub_total', 10, 2)->default(0);
            $table->tinyInteger('qty_send')->default(0)->comment("Send Quantity");
            $table->tinyInteger('qty_remain')->default(0)->comment("Remaining Quantity");
            $table->tinyInteger('item_status')->default(1)->comment("1=Request, 2=Pending, 3=Completed");

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
