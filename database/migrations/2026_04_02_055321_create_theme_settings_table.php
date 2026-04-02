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
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();

            // Primary Colors
            $table->string('primary_color')->default('#f59e0b');           // Main primary color (amber)
            $table->string('primary_color_light')->default('#fbbf24');     // Lighter variant
            $table->string('primary_color_dark')->default('#d97706');      // Darker variant

            // Secondary Colors
            $table->string('secondary_color')->default('#f43f5e');         // Main secondary color (rose)
            $table->string('secondary_color_dark')->default('#e11d48');    // Darker variant

            // Accent Color
            $table->string('accent_color')->default('#8b5cf6');            // Accent color (violet)

            // Background Gradient Colors
            $table->string('bg_gradient_1')->default('#0f0a00');           // Background gradient color 1
            $table->string('bg_gradient_2')->default('#1a0a00');           // Background gradient color 2
            $table->string('bg_gradient_3')->default('#0d0520');           // Background gradient color 3
            $table->string('bg_gradient_4')->default('#001a0d');           // Background gradient color 4
            $table->string('bg_gradient_5')->default('#0f0502');           // Background gradient color 5

            // Button Gradient
            $table->string('btn_gradient_start')->default('#f59e0b');      // Button gradient start
            $table->string('btn_gradient_end')->default('#f43f5e');        // Button gradient end

            // Menu Hover Gradient
            $table->string('menu_hover_start')->default('#f59e0b');        // Menu hover gradient start
            $table->string('menu_hover_end')->default('#f43f5e');          // Menu hover gradient end

            // Text Colors
            $table->string('text_primary')->default('#f5e6cc');            // Primary text color
            $table->string('text_secondary')->default('#fbbf24');          // Secondary text color (brand name)

            // Glass Effect Colors
            $table->string('glass_bg')->default('rgba(255,255,255,0.08)');
            $table->string('glass_border')->default('rgba(255,255,255,0.15)');

            // Active/Is Default
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_settings');
    }
};
