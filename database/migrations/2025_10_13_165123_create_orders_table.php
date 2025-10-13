<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->string('order_number', 50)->unique();
            $table->decimal('sub_total', 18, 2);
            $table->decimal('shipping_fee', 18, 2)->default(0.00);
            $table->decimal('discount_amount', 18, 2)->default(0.00);
            $table->decimal('total_amount', 18, 2);
            $table->string('status')->default('pending_confirmation');
            $table->string('currency', 3)->default('VND');
            $table->decimal('exchange_rate', 12, 6)->default(1.000000);
            $table->decimal('total_amount_base', 18, 2)->nullable();
            $table->string('payment_method');
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_transaction_id', 500)->nullable();
            $table->foreignId('shipping_address_id')->nullable()->constrained('user_addresses')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->foreignId('shipper_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('base_currency')->default('VND');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};