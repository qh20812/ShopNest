<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id('promotion_id');
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->tinyInteger('type'); // 1: Percentage, 2: Fixed Amount
            $table->decimal('value', 18, 2);
            $table->decimal('min_order_amount', 18, 2)->nullable();
            $table->decimal('max_discount_amount', 18, 2)->nullable();
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('priority')->default('medium');
            $table->boolean('stackable')->default(false);
            $table->json('customer_eligibility')->nullable();
            $table->json('geographic_restrictions')->nullable();
            $table->json('product_restrictions')->nullable();
            $table->decimal('budget_limit', 12, 2)->nullable();
            $table->decimal('budget_used', 12, 2)->default(0.00);
            $table->unsignedInteger('daily_usage_limit')->nullable();
            $table->unsignedInteger('daily_usage_count')->default(0);
            $table->unsignedInteger('per_customer_limit')->nullable();
            $table->boolean('first_time_customer_only')->default(false);
            $table->decimal('minimum_cart_value', 10, 2)->nullable();
            $table->decimal('maximum_discount_amount', 10, 2)->nullable();
            $table->json('time_restrictions')->nullable();
            $table->string('auto_apply_condition', 500)->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['priority', 'is_active', 'end_date']);
            $table->index(['stackable', 'is_active']);
            $table->index(['first_time_customer_only', 'is_active']);
            $table->index(['budget_limit', 'budget_used']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};