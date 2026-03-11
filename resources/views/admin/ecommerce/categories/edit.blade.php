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

        <!-- English Name -->
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-language text-primary"></i>
                Category Name (English) <span class="text-danger">*</span>
            </label>
            <input type="text"
                   name="name_en"
                   class="input-dark"
                   placeholder="e.g., Cakes"
                   value="{{ old('name_en', $category->name_en) }}"
                   required
                   autofocus>
            @error('name_en')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bengali Name -->
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-language text-success"></i>
                Category Name (Bengali) <span class="text-danger">*</span>
            </label>
            <input type="text"
                   name="name_bn"
                   class="input-dark"
                   placeholder="উদাহরণ: কেক"
                   value="{{ old('name_bn', $category->name_bn) }}"
                   required>
            @error('name_bn')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Parent Category -->
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-sitemap text-info"></i>
                Parent Category (Optional) / প্যারেন্ট ক্যাটাগরি (ঐচ্ছিক)
            </label>
            <select name="parent_id" class="input-dark">
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
        <div class="mb-4">
            <label class="checkbox-label">
                <input type="checkbox" name="is_active" value="1" class="checkbox-custom" @if(old('is_active', $category->is_active)) checked @endif>
                <span class="ms-2">
                    <strong>Active / সক্রিয়</strong>
                    <small class="d-block text-muted">Show this category on the website</small>
                </span>
            </label>
        </div>

        <!-- Category Info -->
        <div class="help-center-box p-3 mb-4" style="margin-top: 0;">
            <h6 class="fw-bold text-white mb-2">
                <i class="fas fa-info-circle"></i> Current Category Info
            </h6>
            <div class="text-white-50" style="font-size: 12px;">
                <div class="mb-2">
                    <strong>Current Slug:</strong><br>
                    <code class="text-info">{{ $category->slug }}</code>
                </div>
                <div class="mb-2">
                    <strong>Products:</strong><br>
                    <span class="badge bg-primary">{{ $category->products()->count() }}</span>
                </div>
                <div>
                    <strong>Created:</strong><br>
                    {{ $category->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3 mt-5">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Update Category / আপডেট করুন
            </button>
            <a href="{{ route('admin.ecommerce.categories.index') }}" class="btn btn-outline">
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
