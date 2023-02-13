<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('upazila_id');
            $table->unsignedBigInteger('union_id');

            $table->string('name')->nullable()->comment("Address Name");
            $table->string('bn_name')->nullable()->comment("Address Bangle Name");
            $table->string('phone_1')->unique()->nullable()->comment("Phone Number One");
            $table->string('phone_2')->unique()->nullable()->comment("Phone Number Two");
            $table->boolean('status')->default(1)->comment("0=inActive, 1=Active");
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('upazila_id')->references('id')->on('upazilas');
            $table->foreign('union_id')->references('id')->on('unions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
