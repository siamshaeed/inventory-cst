<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment("Market Type Name");
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->boolean('status')->default(1)->comment("0=inActive, 1=Active");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_types');
    }
}
