<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo', 500)->nullable();
            $table->string('banner', 500)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('website', 300)->nullable();
            $table->string('business_type', 100)->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->string('business_license', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('status')->default('pending');
            $table->boolean('is_verified')->default(false);
            $table->decimal('commission_rate', 5, 2)->default(10.00);
            $table->json('shipping_policies')->nullable();
            $table->json('return_policy')->nullable();
            $table->json('social_media')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->unsignedInteger('total_reviews')->default(0);
            $table->unsignedInteger('total_sales')->default(0);
            $table->decimal('total_revenue', 15, 2)->default(0.00);
            $table->string('meta_title', 200)->nullable();
            $table->text('meta_description')->nullable();
            $table->json('keywords')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_verified']);
            $table->index(['owner_id', 'status']);
            $table->index('rating');
            $table->index(['city', 'state', 'country']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};