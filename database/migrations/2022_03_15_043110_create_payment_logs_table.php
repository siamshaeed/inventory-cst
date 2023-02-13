<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('transaction_code');
            $table->string('transaction_currency');
            $table->string('gateway');
            $table->double('paid_amount');
            $table->double('service_charge');
            $table->double('store_amount');
            $table->dateTime('paid_date');
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('system_id')->nullable();
            $table->dateTime('transaction_time');
            $table->dateTime('success_time')->nullable();
            $table->json('raw_response');
            $table->string('payment_step');
            $table->boolean('payment_status');
            $table->timestamps();

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('set null');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_logs');
    }
}
