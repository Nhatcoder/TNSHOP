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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->bigInteger('sub_category_id')->nullable();
            $table->integer('old_price')->nullable();
            $table->integer('price');
            $table->string('short_description', 500)->nullable();
            $table->longText('description')->nullable();
            $table->longText('additional_information')->nullable();
            $table->longText('shipping_returns')->nullable();
            $table->tinyInteger('hot')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');
            $table->tinyInteger('is_delete')->default(1)->comment('1: active, 0: inactive');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
