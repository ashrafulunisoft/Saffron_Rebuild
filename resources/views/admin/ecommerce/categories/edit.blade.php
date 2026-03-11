@extends('layouts.admin')

@section('title', "Edit {$category->name_en} - Saffron Admin")

@section('content')
<div class="role-container" style="max-width: 1000px;">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0;">CATEGORY MANAGEMENT</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1" style="font-size: 2rem;">Edit Category</h2>
        </div>

        <form action="{{ route('admin.ecommerce.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Section 1: Category Information -->
            <div class="permission-title">Category Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Category Name (English) <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text" name="name_en" class="input-dark input-custom" placeholder="e.g., Cakes" value="{{ old('name_en', $category->name_en) }}" required autofocus id="nameEn">
                        <i class="fas fa-tag input-icon"></i>
                    </div>
                    @error('name_en')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Category Name (Bengali) <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text" name="name_bn" class="input-dark input-custom" placeholder="উদাহরণ: কেক" value="{{ old('name_bn', $category->name_bn) }}" required id="nameBn">
                        <i class="fas fa-language input-icon"></i>
                    </div>
                    @error('name_bn')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Parent Category</label>
                    <div class="position-relative">
                        <select name="parent_id" class="input-dark input-custom">
                            <option value="">No Parent (Root Category)</option>
                            @foreach($parentCategories as $parent)
                                <option value="{{ $parent->id }}" @if(old('parent_id', $category->parent_id) == $parent->id) selected @endif>
                                    {{ $parent->name_en }} / {{ $parent->name_bn }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <small class="text-muted">Leave empty for root category</small>
                    @error('parent_id')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Section 2: Status -->
            <div class="permission-title">Status</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <div class="position-relative">
                        <select name="is_active" class="input-dark input-custom">
                            <option value="1" @if(old('is_active', $category->is_active ? '1' : '0') === '1') selected @endif>Active</option>
                            <option value="0" @if(old('is_active') === '0') selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch" style="padding-top: 0.5rem;">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" @if(old('is_featured', $category->is_featured ? '1' : '0') === '1') checked @endif id="isFeatured">
                        <label class="form-check-label text-white" for="isFeatured">
                            <i class="fas fa-star text-warning me-2"></i>Featured Category
                        </label>
                    </div>
                </div>
            </div>

            <!-- Section 3: Category Info -->
            <div class="permission-title">Category Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Current Slug</label>
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 0.75rem;">
                        <code style="color: #fbbf24; font-size: 0.9rem;">{{ $category->slug }}</code>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Products Count</label>
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 0.75rem;">
                        <span class="badge badge-completed">{{ $category->products()->count() }} products</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Created At</label>
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 0.75rem;">
                        <span class="text-white" style="font-size: 0.9rem;">{{ $category->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Updated At</label>
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 0.75rem;">
                        <span class="text-white" style="font-size: 0.9rem;">{{ $category->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.ecommerce.categories.index') }}" class="btn-outline btn-reset" style="text-decoration: none; padding: 0.75rem 2rem; border-radius: 100px; display: inline-flex; align-items: center;">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn-gradient btn-create" style="padding: 0.75rem 2rem; border-radius: 100px;">
                    <i class="fas fa-save me-2"></i>Update Category
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    .permission-title {
        color: var(--accent-blue);
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.3);
    }

    .form-label {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .input-dark {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border-radius: 12px;
        transition: 0.3s;
        width: 100%;
    }

    .input-dark:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    .input-dark::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .input-custom {
        font-size: 0.9rem;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.4);
        pointer-events: none;
    }

    select.input-dark,
    textarea.input-dark {
        padding-left: 1rem;
    }

    select.input-dark {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='rgba(255,255,255,0.5)'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 2.75rem;
    }

    select.input-dark + .input-icon {
        display: none;
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .text-danger {
        color: #ef4444 !important;
    }

    .form-check-input {
        background-color: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255,255,255,0.1);
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: var(--accent-blue);
        border-color: var(--accent-blue);
    }

    .btn-gradient {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        color: #fff;
        border: none;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: 0.3s;
    }

    .btn-outline:hover {
        border-color: var(--accent-blue);
        background: rgba(59, 130, 246, 0.1);
    }

    .glass-card-dark {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(59, 130, 246, 0.1);
    }

    .logo-vms {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .role-container {
        margin: 0 auto;
    }
</style>
@endpush
@endsection
