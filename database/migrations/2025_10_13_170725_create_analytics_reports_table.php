<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('period_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->json('parameters')->nullable();
            $table->json('result_data')->nullable();
            $table->string('file_path')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['type', 'created_at']);
            $table->index(['status', 'created_at']);
            $table->index(['title', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_reports');
    }
};