<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipper_profiles', function (Blueprint $table) {
            $table->foreignId('user_id')->primary()->constrained()->cascadeOnDelete();
            $table->string('id_card_number');
            $table->string('id_card_front_url');
            $table->string('id_card_back_url');
            $table->string('driver_license_number');
            $table->string('driver_license_front_url');
            $table->string('vehicle_type');
            $table->string('license_plate');
            $table->string('status')->default('pending');
            $table->json('operating_area')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipper_profiles');
    }
};