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
        Schema::create('cms_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cms_page_id')->constrained()->onDelete('cascade');
            $table->string('section_key')->unique(); // e.g., 'hero', 'who-we-are', 'specialty'
            $table->string('title_en');
            $table->string('title_bn')->nullable();
            $table->text('subtitle_en')->nullable();
            $table->text('subtitle_bn')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_bn')->nullable();
            $table->text('button_text_en')->nullable();
            $table->text('button_text_bn')->nullable();
            $table->string('button_url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('icon')->nullable(); // For icon sections
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_sections');
    }
};
