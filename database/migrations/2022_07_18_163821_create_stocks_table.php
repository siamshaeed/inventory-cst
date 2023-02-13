<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->tinyInteger('type')->comment("1=Purchase, 2=Sell");
            $table->decimal('total_unit_price', 10, 2)->default(0);
            $table->tinyInteger('total_quantity')->default(0);
            $table->decimal('total_buying_price', 10, 2)->default(0);
            $table->decimal('total_selling_price', 10, 2)->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('stocks');
    }
}
