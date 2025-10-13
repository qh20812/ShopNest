<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('international_addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('type')->default('shipping');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('company', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('address_line_1', 200);
            $table->string('address_line_2', 200)->nullable();
            $table->string('address_line_3', 200)->nullable();
            $table->string('locality', 100);
            $table->string('administrative_area', 100)->nullable();
            $table->string('sub_administrative_area', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->char('country_code', 2);
            $table->string('country_name', 100);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('validation_result')->nullable();
            $table->string('formatted_address', 500)->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_default')->default(false);
            $table->string('timezone', 50)->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['country_code', 'administrative_area']);
            $table->index(['postal_code', 'country_code']);
            $table->index(['is_default', 'type']);
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('international_addresses');
    }
};