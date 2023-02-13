<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');

            $table->dateTime('date')->nullable()->comment("Created Date");
            $table->decimal('grand_amount', 8, 2)->comment("Grand_total_price")->default(0);
            $table->decimal('total_discount', 8, 2)->comment("Grand_total_discount")->default(0);
            $table->decimal('total_pre_due', 8, 2)->comment("Previous_Payment_Due")->default(0);
            $table->decimal('total_amount', 8, 2)->comment("Grand_total_amount")->default(0);

            $table->decimal('total_pay', 8, 2)->comment("Grand_total_pay")->default(0);
            $table->decimal('total_due', 8, 2)->comment("Grand_total_due")->default(0);
            $table->tinyInteger('payment_status')->default(1)->comment("1=unPaid, 2=partiallyPaid, 3=paid");

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
