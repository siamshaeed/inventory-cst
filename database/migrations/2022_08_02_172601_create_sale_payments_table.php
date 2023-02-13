8<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sale_id');

            $table->dateTime('date')->nullable()->comment("Purchase Payment Created Date");
            $table->decimal('amount', 8, 2)->comment("Total Amount")->default(0);
            $table->decimal('pay', 8, 2)->comment("Pay Amount")->default(0);
            $table->decimal('due', 8, 2)->comment("Due Amount")->default(0);
            $table->tinyInteger('status')->default(0)->comment("1=unPaid, 2=Paid");

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_payments');
    }
}
