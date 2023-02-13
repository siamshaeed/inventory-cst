<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id');

            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->tinyInteger('user_type')->default(1)->comment("1=Admin; 2=Workshop; 3=Customer;");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->default('blank_user.jpg');
            $table->integer('otp')->default(0)->comment("OTP Code");
            $table->boolean('is_verified')->default(0)->comment("0=unVerified; 1=Verified");
            $table->boolean('status')->default(0)->comment("1=active;0=Inactive");
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
