<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text')->comment('text, number, boolean, json');
            $table->string('group')->default('general')->comment('general, shipping, payment, etc.');
            $table->timestamps();
        });

        // Insert default shipping settings
        DB::table('settings')->insert([
            [
                'key' => 'shipping_inside_dhaka',
                'value' => '60',
                'type' => 'number',
                'group' => 'shipping',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shipping_outside_dhaka',
                'value' => '120',
                'type' => 'number',
                'group' => 'shipping',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'free_shipping_threshold',
                'value' => '1000',
                'type' => 'number',
                'group' => 'shipping',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
