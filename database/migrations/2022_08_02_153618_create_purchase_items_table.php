<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');

            $table->tinyInteger('trade_type')->comment("1=Buy, 2=Sell");
            $table->decimal('quantity', 10, 2)->default(0)->comment("Quantity or Stock_In");
            $table->decimal('unit_price', 10, 2)->default(0)->comment("Buying_Price");
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('sub_total', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0)->comment("Selling_Price");
            $table->decimal('stock_out', 10, 2)->default(0);
            $table->decimal('stock_available', 10, 2)->default(0);
            $table->boolean('stock_status')->default(1)->comment("1=Stock_Available, 0=Stock_Out");

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('purchase_id')->references('id')->on('purchases');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_items');
    }
}
