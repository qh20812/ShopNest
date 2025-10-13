<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipment_journeys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnDelete();
            $table->string('leg_type');
            $table->foreignId('shipper_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('start_hub_id')->nullable()->constrained('hubs')->nullOnDelete();
            $table->foreignId('end_hub_id')->nullable()->constrained('hubs')->nullOnDelete();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipment_journeys');
    }
};