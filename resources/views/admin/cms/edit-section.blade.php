@extends('layouts.admin')

@section('title', 'Edit Section - Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">EDIT SECTION - {{ $cms->title }}</span>
                </div>
            </div>
            <a href="{{ route('admin.cms.sections', $cms) }}" class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 100px; text-decoration: none;">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>

        <form action="{{ route('admin.cms.sections.update', [$cms, $section]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Basic Info -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <h5 style="color: var(--accent-blue);"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Section Key *</label>
                    <input type="text" name="section_key" class="input-dark input-custom" required value="{{ $section->section_key }}" pattern="[a-z0-9-]+">
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Sort Order</label>
                    <input type="number" name="sort_order" class="input-dark input-custom" value="{{ $section->sort_order }}" min="0">
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Icon</label>
                    <input type="text" name="icon" class="input-dark input-custom" value="{{ $section->icon ?? '' }}" placeholder="e.g., fa-star">
                </div>
            </div>

            <!-- English Content -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <h5 style="color: var(--accent-blue);"><i class="fas fa-language me-2"></i>English Content</h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Title (EN) *</label>
                    <input type="text" name="title_en" class="input-dark input-custom" required value="{{ $section->title_en }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Subtitle (EN)</label>
                    <input type="text" name="subtitle_en" class="input-dark input-custom" value="{{ $section->subtitle_en ?? '' }}">
                </div>

                <div class="col-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Content (EN)</label>
                    <textarea name="content_en" class="input-dark input-custom" rows="4">{{ $section->content_en ?? '' }}</textarea>
                </div>
            </div>

            <!-- Bangla Content -->
            <div class="row g-4 mb-4" style="background: rgba(139, 92, 246, 0.05); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(139, 92, 246, 0.2);">
                <div class="col-12">
                    <h5 style="color: #a855f7;"><i class="fas fa-language me-2"></i>বাংলা বিষয়বস্তু (Bangla Content)</h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">শিরোনাম (Title)</label>
                    <input type="text" name="title_bn" class="input-dark input-custom" value="{{ $section->title_bn ?? '' }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">সাবটাইটেল (Subtitle)</label>
                    <input type="text" name="subtitle_bn" class="input-dark input-custom" value="{{ $section->subtitle_bn ?? '' }}">
                </div>

                <div class="col-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">বিষয়বস্তু (Content)</label>
                    <textarea name="content_bn" class="input-dark input-custom" rows="4">{{ $section->content_bn ?? '' }}</textarea>
                </div>
            </div>

            <!-- Buttons & Links -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <h5 style="color: #22c55e;"><i class="fas fa-link me-2"></i>Buttons & Links</h5>
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Button Text (EN)</label>
                    <input type="text" name="button_text_en" class="input-dark input-custom" value="{{ $section->button_text_en ?? '' }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Button Text (BN)</label>
                    <input type="text" name="button_text_bn" class="input-dark input-custom" value="{{ $section->button_text_bn ?? '' }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Button URL</label>
                    <input type="text" name="button_url" class="input-dark input-custom" value="{{ $section->button_url ?? '' }}">
                </div>

                <div class="col-md-12">
                    <label class="form-label" style="color: rgba(255,255,255,0.7);">Image URL</label>
                    <input type="text" name="image_url" class="input-dark input-custom" value="{{ $section->image_url ?? '' }}">
                </div>
            </div>

            <!-- Settings -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="form-check" style="padding: 1rem; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 10px;">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $section->is_active ? 'checked' : '' }} style="width: 1.2rem; height: 1.2rem; cursor: pointer;">
                        <label class="form-check-label" for="isActive" style="color: rgba(255,255,255,0.8); margin-left: 0.5rem; cursor: pointer;">
                            <i class="fas fa-check-circle me-2" style="color: #22c55e;"></i>Active - Show this section on page
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn-gradient" style="padding: 0.75rem 2rem; border: none; border-radius: 100px;">
                    <i class="fas fa-save me-2"></i>Update Section
                </button>
                <a href="{{ route('admin.cms.sections', $cms) }}" class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
