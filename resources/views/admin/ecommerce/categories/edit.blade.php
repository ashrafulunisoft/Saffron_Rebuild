@extends('layouts.admin')

@section('title', 'Edit Category - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Edit Category <span class="text-muted">ক্যাটাগরি সম্পাদনা করুন</span></h2>
        <p class="text-muted mb-0">Update category information</p>
    </div>
    <a href="{{ route('admin.ecommerce.categories.index') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left me-2"></i> Back to Categories
    </a>
</div>

<div class="glass-card-dark" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.ecommerce.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-secondary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-language text-primary me-2"></i>Edit Category Information</h5>
            </div>
            <div class="card-body">
                <!-- English Name -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Category Name (English) <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name_en"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="e.g., Cakes"
                           value="{{ old('name_en', $category->name_en) }}"
                           required
                           autofocus>
                    @error('name_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bengali Name -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Category Name (Bengali) <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name_bn"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="উদাহরণ: কেক"
                           value="{{ old('name_bn', $category->name_bn) }}"
                           required>
                    @error('name_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Parent Category -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Parent Category (Optional) / প্যারেন্ট ক্যাটাগরি (ঐচ্ছিক)
                    </label>
                    <select name="parent_id" class="form-select bg-dark text-white border-secondary">
                        <option value="">No Parent (Root Category)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}"
                                    @if(old('parent_id', $category->parent_id) == $parent->id) selected @endif>
                                {{ $parent->name_en }} / {{ $parent->name_bn }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" @if(old('is_active', $category->is_active)) checked @endif>
                        <label class="form-check-label text-white" for="isActive">
                            <strong>Active / সক্রিয়</strong>
                            <small class="d-block text-muted">Show this category on the website</small>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Info -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-info border-secondary">
                <h6 class="mb-0 text-white"><i class="fas fa-info-circle me-2"></i>Current Category Info</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Current Slug:</label>
                        <div><code class="text-warning">{{ $category->slug }}</code></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Products:</label>
                        <div><span class="badge bg-primary">{{ $category->products()->count() }}</span></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Created:</label>
                        <div class="text-white">{{ $category->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Updated:</label>
                        <div class="text-white">{{ $category->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Update Category / আপডেট করুন
            </button>
            <a href="{{ route('admin.ecommerce.categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>

<script>
// Live slug preview
document.querySelector('input[name="name_en"]').addEventListener('input', function(e) {
    const slug = e.target.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-|-$/g, '');

    document.getElementById('slugPreview').textContent = slug || '{{ $category->slug }}';
    document.getElementById('namePreview').textContent =
        e.target.value + ' / ' + document.querySelector('input[name="name_bn"]').value || 'Category Name / ক্যাটাগরি নাম';
});

document.querySelector('input[name="name_bn"]').addEventListener('input', function(e) {
    const nameEn = document.querySelector('input[name="name_en"]').value || 'Category Name';
    document.getElementById('namePreview').textContent = nameEn + ' / ' + e.target.value;
});
</script>
@endsection
