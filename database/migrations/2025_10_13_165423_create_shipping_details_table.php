<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_details', function (Blueprint $table) {
            $table->id('shipping_detail_id');
            $table->foreignId('order_id')->unique()->constrained('orders', 'order_id')->cascadeOnDelete();
            $table->string('shipping_provider', 100);
            $table->string('tracking_number', 100)->nullable();
            $table->string('external_order_id', 100)->nullable();
            $table->tinyInteger('status');
            $table->decimal('shipping_fee', 18, 2);
            $table->text('status_history')->nullable(); // JSON
            $table->timestamps();
            $table->softDeletes();

            $table->index('tracking_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_details');
    }
};