<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('good_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            //$table->string('name')->unique()->comment("Product Name");
            $table->string('model')->comment("Product Model Number");
            $table->string('details')->nullable();
            $table->decimal('stock', 10, 2)->comment("Product Stock Count")->default(0);

            $table->string('image')->default('blank_product.jpg');
//            $table->string('image')->nullable();

            $table->boolean('status')->default(1)->comment("0=inActive, 1=Active");
            $table->timestamps();

            $table->foreign('good_id')->references('id')->on('goods');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
