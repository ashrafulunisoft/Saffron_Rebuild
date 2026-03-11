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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('b2b_customer_id')->nullable()->after('user_id')->constrained('b2_b_customers')->nullOnDelete();
            $table->boolean('is_b2b_order')->default(false)->after('b2b_customer_id');
            $table->string('order_type')->default('retail')->after('is_b2b_order'); // retail, wholesale, bulk
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['b2b_customer_id']);
            $table->dropColumn(['b2b_customer_id', 'is_b2b_order', 'order_type']);
        });
    }
};
