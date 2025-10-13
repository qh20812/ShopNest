<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipper_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnDelete();
            $table->foreignId('shipper_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->json('criteria_ratings')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->timestamp('rated_at')->useCurrent();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['order_id', 'customer_id']);
            $table->index(['shipper_id', 'rating']);
            $table->index(['customer_id', 'rated_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipper_ratings');
    }
};