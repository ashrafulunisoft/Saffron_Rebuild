@extends('layouts.admin')

@section('title', 'Edit Blog Post - Admin')

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
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Edit Post</h2>
        </div>

        <form method="POST" action="{{ route('admin.ecommerce.blog.update', $blog) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <!-- Current Post Info -->
            @if($blog->featured_image)
            <div class="alert alert-info mb-4" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3);">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Current Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 8px;">
                    <div>
                        <div class="text-white fw-semibold">Current Featured Image / বর্তমান চিত্র</div>
                        <div class="text-white" style="opacity: 0.7; font-size: 0.85rem;">{{ $blog->featured_image }}</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Basic Information -->
            <div class="permission-title">Basic Information / মৌলিক তথ্য</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="position-relative">
                        <input type="text" name="title_en" class="input-dark input-custom" value="{{ old('title_en', $blog->title_en) }}" placeholder="Title (English) *" required>
                    </div>
                    @error('title_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="position-relative">
                        <input type="text" name="title_bn" class="input-dark input-custom" value="{{ old('title_bn', $blog->title_bn) }}" placeholder="শিরোনাম (বাংলা) *" required>
                    </div>
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
                        <textarea name="content_en" class="input-dark input-custom" rows="10" placeholder="Content (English) *" required>{{ old('content_en', $blog->content_en) }}</textarea>
                    </div>
                    @error('content_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="position-relative">
                        <textarea name="content_bn" class="input-dark input-custom" rows="10" placeholder="বিষয়বস্তু (বাংলা) *" required>{{ old('content_bn', $blog->content_bn) }}</textarea>
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
                        <textarea name="excerpt_en" class="input-dark input-custom" rows="3" placeholder="Short description (English)">{{ old('excerpt_en', $blog->excerpt_en) }}</textarea>
                    </div>
                    @error('excerpt_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="position-relative">
                        <textarea name="excerpt_bn" class="input-dark input-custom" rows="3" placeholder="সংক্ষিপ্ত বিবরণ (বাংলা)">{{ old('excerpt_bn', $blog->excerpt_bn) }}</textarea>
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
                    <small class="text-white" style="opacity: 0.6;">Leave empty to keep current image. Recommended size: 1200x630px. Max size: 2MB.</small>
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
                                <option value="{{ $category }}" {{ old('category', $blog->category) === $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="position-relative">
                        <input type="text" name="tags" class="input-dark input-custom" value="{{ old('tags', $blog->tags) }}" placeholder="Tags (comma separated) / ট্যাগ">
                    </div>
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
                            <option value="draft" {{ old('status', $blog->status) === 'draft' ? 'selected' : '' }}>Draft / খসড়া</option>
                            <option value="published" {{ old('status', $blog->status) === 'published' ? 'selected' : '' }}>Published / প্রকাশিত</option>
                            <option value="archived" {{ old('status', $blog->status) === 'archived' ? 'selected' : '' }}>Archived / সংরক্ষিত</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" style="width: 50px; height: 26px;" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label text-white ms-3" for="is_featured">
                            Featured Post / বৈশিষ্ট্যযুক্ত পোস্ট
                        </label>
                    </div>
                </div>
            </div>

            <!-- Post Statistics -->
            <div class="alert alert-info mb-4" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3);">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="text-white" style="opacity: 0.7; font-size: 0.85rem;">Views / দর্শন</div>
                        <div class="text-white fw-800" style="font-size: 1.5rem;">{{ $blog->views }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-white" style="opacity: 0.7; font-size: 0.85rem;">Created / তৈরি</div>
                        <div class="text-white">{{ $blog->created_at->format('M d, Y') }}</div>
                    </div>
                    @if($blog->published_at)
                    <div class="col-md-3">
                        <div class="text-white" style="opacity: 0.7; font-size: 0.85rem;">Published / প্রকাশিত</div>
                        <div class="text-white">{{ $blog->published_at->format('M d, Y') }}</div>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="text-white" style="opacity: 0.7; font-size: 0.85rem;">Status / অবস্থা</div>
                        <div class="text-white">{{ ucfirst($blog->status) }}</div>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="permission-title">SEO Settings / SEO সেটিংস</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <div class="position-relative">
                        <input type="text" name="meta_title" class="input-dark input-custom" value="{{ old('meta_title', $blog->meta_title) }}" placeholder="Meta Title">
                    </div>
                    @error('meta_title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="position-relative">
                        <textarea name="meta_description" class="input-dark input-custom" rows="2" placeholder="Meta Description">{{ old('meta_description', $blog->meta_description) }}</textarea>
                    </div>
                    @error('meta_description')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="position-relative">
                        <input type="text" name="meta_keywords" class="input-dark input-custom" value="{{ old('meta_keywords', $blog->meta_keywords) }}" placeholder="Meta Keywords (comma separated)">
                    </div>
                    @error('meta_keywords')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn-gradient" style="padding: 0.75rem 2rem; border-radius: 100px; border: none;">
                    <i class="fas fa-save me-2"></i> Update Post / আপডেট করুন
                </button>
                <a href="{{ route('admin.ecommerce.blog.show', $blog) }}" class="btn-gradient" style="padding: 0.75rem 2rem; border-radius: 100px; background: rgba(59, 130, 246, 0.3); text-decoration: none;">
                    <i class="fas fa-eye me-2"></i> View / দেখুন
                </a>
                <a href="{{ route('admin.ecommerce.blog.index') }}" class="btn-gradient" style="padding: 0.75rem 2rem; border-radius: 100px; background: rgba(107, 114, 128, 0.3); text-decoration: none;">
                    <i class="fas fa-times me-2"></i> Cancel / বাতিল
                </a>
            </div>
        </form>
    </div>
</div>

@include('admin.ecommerce.partials.common-styles')
@endsection
