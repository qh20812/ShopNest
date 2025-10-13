<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->foreign('preferred_category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
            
            $table->foreign('preferred_brand_id')
                ->references('id')
                ->on('brands')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropForeign(['preferred_category_id']);
            $table->dropForeign(['preferred_brand_id']);
        });
    }
};
