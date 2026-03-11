<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This migration safely renames product_orders to orders
     * and updates the foreign key in order_items table.
     * NO DATA LOSS - All existing data is preserved.
     */
    public function up(): void
    {
        // Step 1: Drop foreign key constraint from order_items
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        // Step 2: Rename the table from product_orders to orders
        Schema::rename('product_orders', 'orders');

        // Step 3: Re-add foreign key constraint pointing to orders table
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Drop foreign key constraint from order_items
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        // Step 2: Rename the table back from orders to product_orders
        Schema::rename('orders', 'product_orders');

        // Step 3: Re-add foreign key constraint pointing to product_orders table
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')
                  ->references('id')
                  ->on('product_orders')
                  ->onDelete('cascade');
        });
    }
};
