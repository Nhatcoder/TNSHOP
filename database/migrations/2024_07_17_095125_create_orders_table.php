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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('code_order', 255);
            $table->string('name', 255);
            $table->string('phone', 12);
            $table->string('city', 255);
            $table->string('district', 255);
            $table->string('ward', 255);
            $table->string('home_address', 255);
            $table->string('discount_code', 10)->nullable();
            $table->integer('total_price');
            $table->integer('total_amount');
            $table->integer('shipping_id')->nullable();
            $table->text('note');
            $table->string('payment', 20);
            $table->integer('status')->default(1);
            $table->tinyInteger('is_review')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
