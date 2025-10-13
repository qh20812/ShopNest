<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flash_sale_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flash_sale_event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->constrained('product_variants', 'variant_id')->cascadeOnDelete();
            $table->decimal('flash_sale_price', 15, 2);
            $table->integer('quantity_limit')->default(0);
            $table->integer('sold_count')->default(0);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->integer('max_quantity_per_user')->default(1);
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['flash_sale_event_id', 'product_variant_id'], 'flash_sale_products_unique');
            $table->index(['flash_sale_event_id', 'sold_count']);
            $table->index('product_variant_id');
            $table->index('flash_sale_price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flash_sale_products');
    }
};