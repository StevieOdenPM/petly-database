<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
        });

        Schema::create('users_couriers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_userid')->primary();
            $table->string('phone_num');
            $table->string('status');
            $table->foreign('user_userid')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('users_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('user_userid')->primary();
            $table->string('phone_num');
            $table->foreign('user_userid')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('users_customer', function (Blueprint $table) {
            $table->unsignedBigInteger('user_userid')->primary();
            $table->string('phone_num');
            $table->string('address');
            $table->foreign('user_userid')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('pet', function (Blueprint $table) {
            $table->unsignedBigInteger('pet_id')->primary();
            $table->string('pet_name');
            $table->string('pet_gender');
            $table->integer('pet_weight');
            $table->string('pet_type');
            $table->unsignedBigInteger('details_customer_id');
            $table->foreign('details_customer_id')->references('user_userid')->on('users_customer')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('users_couriers');
        Schema::dropIfExists('users_admin');
        Schema::dropIfExists('users_customer');
        Schema::dropIfExists('pet');
    }
};
