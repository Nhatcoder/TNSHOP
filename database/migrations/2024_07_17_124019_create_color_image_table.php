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
        Schema::create('color_image', function (Blueprint $table) {
            $table->id();
            $table->string('color_name', 255)->nullable();
            $table->string('image_name', 255)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_image');
    }
};
