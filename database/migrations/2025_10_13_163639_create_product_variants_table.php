<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('variant_id');
            $table->foreignId('product_id')->constrained('products', 'product_id')->cascadeOnDelete();
            $table->string('sku', 100)->unique();
            $table->decimal('price', 18, 2);
            $table->decimal('discount_price', 18, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('reserved_quantity')->default(0);
            $table->integer('available_quantity')->virtualAs('stock_quantity - reserved_quantity');
            $table->integer('minimum_stock_level')->default(0);
            $table->boolean('track_inventory')->default(true);
            $table->boolean('allow_backorder')->default(false);
            $table->timestamp('last_restocked_at')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['available_quantity', 'created_at']);
            $table->index(['minimum_stock_level', 'available_quantity']);
            $table->index('track_inventory');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};