<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('reviews', 'review_id')->cascadeOnDelete();
            $table->string('media_type')->default('image');
            $table->string('file_name');
            $table->string('file_path', 500);
            $table->string('mime_type', 100);
            $table->unsignedInteger('file_size');
            $table->json('metadata')->nullable();
            $table->smallInteger('display_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['review_id', 'display_order']);
            $table->index(['media_type', 'created_at']);
            $table->index('is_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_media');
    }
};