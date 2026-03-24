@extends('layouts.admin')

@section('title', 'Create Blog Post - Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">BLOG MANAGEMENT</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Create New Post</h2>
        </div>

        <form method="POST" action="{{ route('admin.ecommerce.blog.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information -->
            <div class="permission-title">Basic Information / মৌলিক তথ্য</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <input type="text" name="title_en" class="input-dark input-custom" placeholder="Title (English) *" required>
                    @error('title_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" name="title_bn" class="input-dark input-custom" placeholder="শিরোনাম (বাংলা) *" required>
                    @error('title_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Content -->
            <div class="permission-title">Content / বিষয়বস্তু</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <div class="position-relative">
                        <textarea name="content_en" class="input-dark input-custom" rows="10" placeholder="Content (English) *" required></textarea>
                    </div>
                    @error('content_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="position-relative">
                        <textarea name="content_bn" class="input-dark input-custom" rows="10" placeholder="বিষয়বস্তু (বাংলা) *" required></textarea>
                    </div>
                    @error('content_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Excerpt -->
            <div class="permission-title">Excerpt / সারসংক্ষেপ</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="position-relative">
                        <textarea name="excerpt_en" class="input-dark input-custom" rows="3" placeholder="Short description (English)"></textarea>
                    </div>
                    @error('excerpt_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="position-relative">
                        <textarea name="excerpt_bn" class="input-dark input-custom" rows="3" placeholder="সংক্ষিপ্ত বিবরণ (বাংলা)"></textarea>
                    </div>
                    @error('excerpt_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Featured Image -->
            <div class="permission-title">Featured Image / বৈশিষ্ট্যযুক্ত চিত্র</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <input type="file" name="featured_image" class="input-dark input-custom" accept="image/*">
                    <small class="text-white" style="opacity: 0.6;">Recommended size: 1200x630px. Max size: 5MB. Supported: JPG, JPEG, PNG, WEBP</small>
                    @error('featured_image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Category & Tags -->
            <div class="permission-title">Category & Tags / বিভাগ এবং ট্যাগ</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="position-relative">
                        <select name="category" class="input-dark input-custom">
                            <option value="">Select Category / বিভাগ নির্বাচন করুন</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" name="tags" class="input-dark input-custom" placeholder="Tags (comma separated) / ট্যাগ">
                    <small class="text-white" style="opacity: 0.6;">Example: recipe, baking, cake</small>
                    @error('tags')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Status & Featured -->
            <div class="permission-title">Publication / প্রকাশনা</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="position-relative">
                        <select name="status" class="input-dark input-custom" required>
                            <option value="draft">Draft / খসড়া</option>
                            <option value="published">Published / প্রকাশিত</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" style="width: 50px; height: 26px;">
                        <label class="form-check-label text-white ms-3" for="is_featured">
                            Featured Post / বৈশিষ্ট্যযুক্ত পোস্ট
                        </label>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="permission-title">SEO Settings / SEO সেটিংস</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <input type="text" name="meta_title" class="input-dark input-custom" placeholder="Meta Title">
                    @error('meta_title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="position-relative">
                        <textarea name="meta_description" class="input-dark input-custom" rows="2" placeholder="Meta Description"></textarea>
                    </div>
                    @error('meta_description')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <input type="text" name="meta_keywords" class="input-dark input-custom" placeholder="Meta Keywords (comma separated)">
                    @error('meta_keywords')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn-gradient" style="padding: 0.75rem 2rem; border-radius: 100px; border: none;">
                    <i class="fas fa-save me-2"></i> Save Post / সংরক্ষণ করুন
                </button>
                <a href="{{ route('admin.ecommerce.blog.index') }}" class="btn-gradient" style="padding: 0.75rem 2rem; border-radius: 100px; background: rgba(107, 114, 128, 0.3); text-decoration: none;">
                    <i class="fas fa-times me-2"></i> Cancel / বাতিল
                </a>
            </div>
        </form>
    </div>
</div>

@include('admin.ecommerce.partials.common-styles')
@endsection
