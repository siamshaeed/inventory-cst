<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('order_item_id');
            $table->unsignedBigInteger('product_id');
            $table->dateTime('date')->nullable()->comment("Created Date");
            $table->decimal('qty', 8, 2)->comment("Quantity")->default(0);
            $table->decimal('unit_price', 8, 2)->default(0)->comment("Unit_Price");
            $table->decimal('total_price', 8, 2)->default(0)->comment("Total_Price");
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('average_discount', 8, 2)->default(0);
            $table->decimal('sub_total', 8, 2)->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('order_item_id')->references('id')->on('order_items');
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
        Schema::dropIfExists('sale_items');
    }
}
