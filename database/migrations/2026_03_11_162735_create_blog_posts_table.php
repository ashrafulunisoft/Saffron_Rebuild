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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            // Bilingual title
            $table->string('title_en');
            $table->string('title_bn');

            // Bilingual slug
            $table->string('slug')->unique();

            // Bilingual content
            $table->text('content_en');
            $table->longText('content_bn');

            // Excerpt (short description)
            $table->text('excerpt_en')->nullable();
            $table->text('excerpt_bn')->nullable();

            // Featured image
            $table->string('featured_image')->nullable();

            // Author (foreign key to users)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Category
            $table->string('category')->nullable();

            // Tags (comma-separated)
            $table->string('tags')->nullable();

            // Status
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            // Featured post
            $table->boolean('is_featured')->default(false);

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // View count
            $table->integer('views')->default(0);

            // Published at
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
