<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_promotion', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnDelete();
            $table->foreignId('promotion_id')->constrained('promotions', 'promotion_id')->cascadeOnDelete();
            $table->decimal('discount_applied', 18, 2);
            $table->primary(['order_id', 'promotion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_promotion');
    }
};