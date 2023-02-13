<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_dues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('purchase_id');

            $table->dateTime('date')->nullable()->comment("Purchase Payment Created Date");
            $table->decimal('amount', 10, 2)->comment("Remaining Amount")->default(0);
            $table->decimal('pay', 10, 2)->comment("Pay Amount")->default(0);
            $table->decimal('due', 10, 2)->comment("Due Amount")->default(0);
            $table->tinyInteger('status')->default(0)->comment("1=unPaid, 2=Paid");

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('purchase_id')->references('id')->on('purchases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_dues');
    }
}
