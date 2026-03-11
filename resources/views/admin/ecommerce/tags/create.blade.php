@extends('layouts.admin')

@section('title', 'Create Tag - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Create Tag <span class="text-white">ট্যাগ তৈরি করুন</span></h2>
        <p class="text-white mb-0">Add a new product tag</p>
    </div>
    <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left me-2"></i> Back to Tags
    </a>
</div>

<div class="glass-card-dark" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.ecommerce.tags.store') }}" method="POST">
        @csrf

        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-secondary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-tag text-primary me-2"></i>Tag Information</h5>
            </div>
            <div class="card-body">
                <!-- English Name -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Tag Name (English) <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name_en"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="e.g., Organic, Premium, Best Seller"
                           value="{{ old('name_en') }}"
                           required
                           autofocus>
                    @error('name_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bengali Name -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Tag Name (Bengali) <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name_bn"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="উদাহরণ: অর্গানিক, প্রিমিয়াম, সেরা বিক্রয়"
                           value="{{ old('name_bn') }}"
                           required>
                    @error('name_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="alert alert-info border-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Tip:</strong> Tags help customers find products. Examples: "Organic", "Premium", "Best Seller", "New Arrival", "Limited Edition"
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Save Tag / সংরক্ষণ করুন
            </button>
            <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>

@endsection
