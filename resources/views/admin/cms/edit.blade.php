@extends('layouts.admin')

@section('title', 'Edit CMS Page - Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">CMS PAGES</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Edit Page</h2>
                <a href="{{ route('admin.ecommerce.cms.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.3); color: white; margin-bottom: 1.5rem; border-radius: 12px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.3); color: white; margin-bottom: 1.5rem; border-radius: 12px;">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(239, 68, 68, 0.3); color: white; margin-bottom: 1.5rem; border-radius: 12px;">
            <strong><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</strong>
            <ul style="margin-top: 0.5rem; margin-bottom: 0;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
        </div>
        @endif

        <form action="{{ route('admin.ecommerce.cms.update', $cms) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- English Content -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <h5 style="color: var(--accent-blue); margin-bottom: 1rem;"><i class="fas fa-language me-2"></i>English Content / ইংরেজি বিষয়বস্তু</h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Page Title / শিরোনাম *</label>
                    <input type="text" name="title_en" class="input-dark input-custom" required placeholder="e.g., About Us" value="{{ old('title_en', $cms->title_en) }}">
                    @error('title_en') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Slug / স্লাগ *</label>
                    <input type="text" name="slug" class="input-dark input-custom" required placeholder="e.g., about-us" value="{{ old('slug', $cms->slug) }}" pattern="[a-z0-9-]+" title="Only lowercase letters, numbers, and hyphens">
                    @error('slug') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Excerpt / সারাংশ</label>
                    <textarea name="excerpt_en" class="input-dark input-custom" rows="2" placeholder="Short description...">{{ old('excerpt_en', $cms->excerpt_en) }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Content / বিষয়বস্তু</label>
                    <textarea name="content_en" class="input-dark input-custom" rows="10" placeholder="Full page content...">{{ old('content_en', $cms->content_en) }}</textarea>
                </div>
            </div>

            <!-- Bangla Content -->
            <div class="row g-4 mb-4" style="background: rgba(139, 92, 246, 0.05); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(139, 92, 246, 0.2);">
                <div class="col-12">
                    <h5 style="color: #a855f7; margin-bottom: 1rem;"><i class="fas fa-language me-2"></i>বাংলা বিষয়বস্তু (Bangla Content)</h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">শিরোনাম (Title)</label>
                    <input type="text" name="title_bn" class="input-dark input-custom" placeholder="যেমন: আমাদের সম্পর্কে" value="{{ old('title_bn', $cms->title_bn) }}">
                </div>

                <div class="col-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">সারাংশ (Excerpt)</label>
                    <textarea name="excerpt_bn" class="input-dark input-custom" rows="2" placeholder="সংক্ষিপ্ত বিবরণ...">{{ old('excerpt_bn', $cms->excerpt_bn) }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">বিষয়বস্তু (Content)</label>
                    <textarea name="content_bn" class="input-dark input-custom" rows="10" placeholder="সম্পূর্ণ পেজ বিষয়বস্তু...">{{ old('content_bn', $cms->content_bn) }}</textarea>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <h5 style="color: #22c55e; margin-bottom: 1rem;"><i class="fas fa-search me-2"></i>SEO Settings / এসইও সেটিংস</h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Meta Title</label>
                    <input type="text" name="meta_title" class="input-dark input-custom" placeholder="SEO title..." value="{{ old('meta_title', $cms->meta_title) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="input-dark input-custom" placeholder="keyword1, keyword2,..." value="{{ old('meta_keywords', $cms->meta_keywords) }}">
                </div>

                <div class="col-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Meta Description</label>
                    <textarea name="meta_description" class="input-dark input-custom" rows="2" placeholder="SEO description...">{{ old('meta_description', $cms->meta_description) }}</textarea>
                </div>
            </div>

            <!-- Settings -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="form-check" style="padding: 1rem; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 10px;">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $cms->is_active ? 'checked' : '' }} style="width: 1.2rem; height: 1.2rem; cursor: pointer;">
                        <label class="form-check-label" for="isActive" style="color: rgba(255,255,255,0.8); margin-left: 0.5rem; cursor: pointer;">
                            <i class="fas fa-check-circle me-2" style="color: #22c55e;"></i>Active / সক্রিয় - Show this page on frontend
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn-gradient" style="padding: 0.75rem 2rem; border: none; border-radius: 100px;">
                    <i class="fas fa-save me-2"></i>Update Page
                </button>
                <a href="{{ route('admin.ecommerce.cms.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
