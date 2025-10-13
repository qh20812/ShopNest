<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Tên gói (e.g., Basic, Premium)
            $table->string('stripe_id')->nullable()->unique(); // ID từ Stripe
            $table->string('paypal_id')->nullable()->unique(); // ID từ PayPal
            $table->string('gateway'); // 'stripe', 'paypal', 'momo', 'vnpay'
            $table->decimal('amount', 18, 2); // Giá gói
            $table->string('currency', 3); // Tiền tệ (e.g., VND, USD)
            $table->string('status'); // 'active', 'cancelled', 'past_due'
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->json('metadata')->nullable(); // Dữ liệu bổ sung (e.g., Momo transId)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};