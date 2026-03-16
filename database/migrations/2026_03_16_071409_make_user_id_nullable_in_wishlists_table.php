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
        Schema::table('wishlists', function (Blueprint $table) {
            // Drop the unique constraint first
            $table->dropUnique(['user_id', 'product_id']);

            // Make user_id nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Add new unique constraint that allows null user_id
            $table->unique(['user_id', 'product_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            // Drop the new unique constraint
            $table->dropUnique(['user_id', 'product_id', 'session_id']);

            // Restore original unique constraint
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            $table->unique(['user_id', 'product_id']);
        });
    }
};
