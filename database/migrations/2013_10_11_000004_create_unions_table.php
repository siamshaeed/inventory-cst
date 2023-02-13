<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upazila_id');

            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->string('url')->nullable();
            $table->boolean('status')->default(1)->comment("1=Active; 0=inActive");
            $table->timestamps();

            $table->foreign('upazila_id')->references('id')->on('upazilas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unions');
    }
}
