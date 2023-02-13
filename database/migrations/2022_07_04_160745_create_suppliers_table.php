<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_type_id');
            $table->string('name')->nullable()->comment("Supplier Name");
            $table->string('title')->nullable();
            $table->string('phone')->unique()->nullable()->comment("Phone Number");
            $table->string('address')->nullable();
            $table->string('slug')->unique();
            $table->boolean('status')->default(1)->comment("0=inActive, 1=Active");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('market_type_id')->references('id')->on('market_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
