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
        Schema::create('discount_code', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable()->comment('Tên mã giảm giá');
            $table->string('name_code', 255)->nullable()->comment('Mã giảm giá');
            $table->string('type', 20)->nullable()->comment('Loại giảm giá');
            $table->decimal('amount', 10, 2)->nullable()->comment('Số tiền giảm giá hoặc phần trăm giảm giá');
            $table->dateTime('expire_date')->nullable()->comment('Ngày hết hạn');
            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_code');
    }
};
