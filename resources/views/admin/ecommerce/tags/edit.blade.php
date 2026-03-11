@extends('layouts.admin')

@section('title', 'Edit Tag - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Edit Tag <span class="text-white">ট্যাগ সম্পাদনা করুন</span></h2>
        <p class="text-white mb-0">Update tag information</p>
    </div>
    <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left me-2"></i> Back to Tags
    </a>
</div>

<div class="glass-card-dark" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.ecommerce.tags.update', $tag) }}" method="POST">
        @csrf
        @method('PUT')

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
                           value="{{ old('name_en', $tag->name_en) }}"
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
                           value="{{ old('name_bn', $tag->name_bn) }}"
                           required>
                    @error('name_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tag Info -->
                <div class="card bg-secondary border-0 mb-3">
                    <div class="card-body">
                        <h6 class="text-white mb-3"><i class="fas fa-info-circle me-2"></i>Tag Information</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Tag ID:</label>
                                <div><code class="text-warning">#{{ $tag->id }}</code></div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-muted small">Products Using:</label>
                                <div><span class="badge bg-primary">{{ $tag->products()->count() }}</span></div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Created:</label>
                                <div class="text-white">{{ $tag->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Updated:</label>
                                <div class="text-white">{{ $tag->updated_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning if tag is in use -->
                @if($tag->products()->count() > 0)
                    <div class="alert alert-warning border-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This tag is being used by {{ $tag->products()->count() }} product(s). Changes will affect those products.
                    </div>
                @endif
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Update Tag / আপডেট করুন
            </button>
            <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>

@endsection
