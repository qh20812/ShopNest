<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnDelete();
            $table->string('type');
            $table->decimal('amount', 18, 2);
            $table->string('currency', 3);
            $table->string('gateway');
            $table->string('gateway_transaction_id')->nullable();
            $table->string('status')->default('completed');
            $table->string('refund_reason')->nullable();
            $table->json('metadata')->nullable();
            $table->index(['gateway', 'status']); // Tối ưu query theo gateway và status
            $table->index('gateway_transaction_id'); // Nhanh cho webhook lookup
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};