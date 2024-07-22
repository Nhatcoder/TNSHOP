<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sub_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_category');
    }
};
