@extends('layouts.admin')

@section('title', "Edit {$tag->name_en} - Saffron Admin")

@section('content')
<div class="role-container" style="max-width: 800px;">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0;">TAG MANAGEMENT</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1" style="font-size: 2rem;">Edit Tag</h2>
        </div>

        <form action="{{ route('admin.ecommerce.tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Section 1: Tag Information -->
            <div class="permission-title">Tag Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Tag Name (English) <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text"
                               name="name_en"
                               class="input-dark input-custom"
                               placeholder="e.g., Organic, Premium, Best Seller"
                               value="{{ old('name_en', $tag->name_en) }}"
                               required
                               autofocus>
                    </div>
                    @error('name_en')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Tag Name (Bengali) <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text"
                               name="name_bn"
                               class="input-dark input-custom"
                               placeholder="উদাহরণ: অর্গানিক, প্রিমিয়াম"
                               value="{{ old('name_bn', $tag->name_bn) }}"
                               required>
                    </div>
                    @error('name_bn')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Section 2: Tag Statistics -->
            <div class="permission-title">Tag Statistics</div>
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem;">
                        <label class="text-muted" style="font-size: 0.75rem;">TAG ID</label>
                        <div><code style="color: #fbbf24; font-size: 0.9rem;">#{{ $tag->id }}</code></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem;">
                        <label class="text-muted" style="font-size: 0.75rem;">PRODUCTS USING</label>
                        <div><span class="badge badge-visit-type">{{ $tag->products()->count() }}</span></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem;">
                        <label class="text-muted" style="font-size: 0.75rem;">CREATED</label>
                        <div class="text-white" style="font-size: 0.9rem;">{{ $tag->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>

            @if($tag->products()->count() > 0)
                <div class="p-3 rounded mb-5" style="background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.3);">
                    <i class="fas fa-exclamation-triangle" style="color: #fbbf24; margin-right: 0.5rem;"></i>
                    <span style="font-size: 0.85rem; opacity: 0.8;">
                        This tag is being used by {{ $tag->products()->count() }} product(s). Changes will affect those products.
                    </span>
                </div>
            @endif

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn-outline btn-reset" style="text-decoration: none; padding: 0.75rem 2rem; border-radius: 100px; display: inline-flex; align-items: center;">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn-gradient btn-create" style="padding: 0.75rem 2rem; border-radius: 100px;">
                    <i class="fas fa-save me-2"></i>Update Tag
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
        padding: 0.75rem 1rem;
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

    

    .text-muted {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .text-danger {
        color: #ef4444 !important;
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
