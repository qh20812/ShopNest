<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wishlist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products', 'product_id')->cascadeOnDelete();
            $table->json('product_variant')->nullable();
            $table->decimal('price_when_added', 10, 2)->nullable();
            $table->text('note')->nullable();
            $table->unsignedInteger('priority')->default(0);
            $table->boolean('notify_price_drop')->default(false);
            $table->boolean('notify_back_in_stock')->default(false);
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['wishlist_id', 'product_id']);
            $table->index(['wishlist_id', 'priority']);
            $table->index(['product_id', 'created_at']);
            $table->index(['notify_price_drop', 'notify_back_in_stock']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlist_items');
    }
};