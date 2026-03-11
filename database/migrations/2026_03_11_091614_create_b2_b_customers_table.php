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
        Schema::create('b2_b_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Company Information
            $table->string('company_name');
            $table->string('trade_license_number')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('business_type')->default('retailer'); // retailer, wholesaler, distributor, etc.

            // Contact Information
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('billing_address')->nullable();
            $table->text('shipping_address')->nullable();

            // Credit & Payment Terms
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->decimal('current_balance', 12, 2)->default(0);
            $table->string('payment_terms')->default('cash_on_delivery'); // cash_on_delivery, net_30, net_60, etc.
            $table->integer('payment_days')->default(0); // Days allowed for payment (0 = immediate)

            // Pricing & Discounts
            $table->string('pricing_tier')->default('standard'); // standard, silver, gold, platinum
            $table->decimal('wholesale_discount', 5, 2)->default(0); // Percentage discount on wholesale

            // Approval Status
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');

            // Additional Info
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b2_b_customers');
    }
};
