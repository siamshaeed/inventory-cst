<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('supplier_id');

            $table->dateTime('date')->nullable()->comment("Purchase Created Date");
            $table->string('invoice_number')->unique();
            $table->tinyInteger('purchase_status')->default(1)->comment("1=Ordered, 2=Pending, 3=Received");

            $table->decimal('grand_amount', 10, 2)->comment("Grand_total_price")->default(0);
            $table->decimal('total_discount', 10, 2)->comment("Grand_total_discount")->default(0);
            $table->decimal('total_amount', 10, 2)->comment("Grand_total_amount")->default(0);

            $table->decimal('total_pay', 10, 2)->comment("Grand_total_pay")->default(0);
            $table->decimal('total_due', 10, 2)->comment("Grand_total_due")->default(0);
            $table->tinyInteger('payment_status')->default(1)->comment("1=unPaid, 2=partiallyPaid, 3=paid");

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
        Schema::dropIfExists('purchases');
    }
}
