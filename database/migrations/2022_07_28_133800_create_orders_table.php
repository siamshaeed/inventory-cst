<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('supplier_id');

            $table->dateTime('date')->nullable()->comment("Purchase Created Date");
            $table->string('order_number')->unique();

            $table->decimal('grand_total', 8, 2)->comment("Grand_total_price")->default(0);
            $table->decimal('total_discount', 8, 2)->comment("Grand_total_discount")->default(0);
            $table->decimal('total_amount', 8, 2)->comment("Grand_total_amount")->default(0);
            $table->decimal('total_pre_due', 8, 2)->comment("Total_Previous_Due")->default(0);

            $table->string('quotation_image')->default('blank_quotation.jpg')->comment("Quotation Image");
            $table->tinyInteger('order_status')->default(1)->comment("1=Request, 2=Pending, 3=Completed");
            $table->tinyInteger('sale_status')->default(0)->comment("0=Not_Sale, 1=Sale_Completed");

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
