@extends('layouts.admin')

@section('title', "Edit {$product->name_en} - Saffron Admin")

@section('content')
<div class="role-container" style="max-width: 1000px;">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0;">PRODUCT MANAGEMENT</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1" style="font-size: 2rem;">Edit Product</h2>
        </div>

        <form action="{{ route('admin.ecommerce.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Section 1: Basic Information -->
            <div class="permission-title">Basic Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">SKU <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text" name="sku" class="input-dark input-custom" placeholder="e.g., CAKE-001" value="{{ old('sku', $product->sku) }}" required>
                        <i class="fas fa-barcode input-icon"></i>
                    </div>
                    @error('sku')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select name="category_id" class="input-dark input-custom" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected @endif>
                                    {{ $category->name_en }} / {{ $category->name_bn }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Product Name (English) <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text" name="name_en" class="input-dark input-custom" placeholder="e.g., Chocolate Cake" value="{{ old('name_en', $product->name_en) }}" required>
                        <i class="fas fa-tag input-icon"></i>
                    </div>
                    @error('name_en')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Product Name (Bengali) <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="text" name="name_bn" class="input-dark input-custom" placeholder="উদাহরণ: চকোলেট কেক" value="{{ old('name_bn', $product->name_bn) }}" required>
                        <i class="fas fa-language input-icon"></i>
                    </div>
                    @error('name_bn')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Section 2: Pricing -->
            <div class="permission-title">Pricing Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Regular Price (৳) <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="number" name="price" class="input-dark input-custom" placeholder="0.00" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                        <i class="fas fa-dollar-sign input-icon"></i>
                    </div>
                    @error('price')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sale Price (৳)</label>
                    <div class="position-relative">
                        <input type="number" name="sale_price" class="input-dark input-custom" placeholder="0.00" step="0.01" min="0" value="{{ old('sale_price', $product->sale_price) }}">
                        <i class="fas fa-tags input-icon"></i>
                    </div>
                    <small class="text-muted">Leave empty if no sale</small>
                </div>
            </div>

            <!-- Section 3: Inventory -->
            <div class="permission-title">Inventory & Status</div>
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <label class="form-label">Stock <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="number" name="stock" class="input-dark input-custom" placeholder="0" min="0" value="{{ old('stock', $product->stock) }}" required>
                        <i class="fas fa-boxes input-icon"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Weight (kg)</label>
                    <div class="position-relative">
                        <input type="number" name="weight" class="input-dark input-custom" placeholder="0.00" step="0.01" min="0" value="{{ old('weight', $product->weight) }}">
                        <i class="fas fa-weight input-icon"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <div class="position-relative">
                        <select name="is_active" class="input-dark input-custom">
                            <option value="1" @if(old('is_active', $product->is_active ? '1' : '0') === '1') selected @endif>Active</option>
                            <option value="0" @if(old('is_active') === '0') selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check form-switch w-100">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" @if(old('is_featured', $product->is_featured ? '1' : '0') === '1') checked @endif id="is_featured">
                        <label class="form-check-label text-white" for="is_featured">
                            <i class="fas fa-star text-warning me-2"></i>Featured
                        </label>
                    </div>
                </div>
            </div>

            <!-- Section 4: Tags -->
            <div class="permission-title">Tags</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Select Tags</label>
                    <div class="position-relative">
                        <select name="tags[]" class="input-dark input-custom" multiple style="height: 100px;">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" @if(old('tags.*') && in_array($tag->id, old('tags') ?? []) || $product->tags()->where('id', $tag->id)->exists()) selected @endif>
                                    {{ $tag->name_en }} / {{ $tag->name_bn }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <small class="text-muted">Hold Ctrl/Cmd to select multiple tags</small>
                </div>
            </div>

            <!-- Section 5: Images -->
            <div class="permission-title">Product Images</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Current Images</label>
                    <div class="d-flex flex-wrap gap-3 mb-3">
                        @foreach($product->images as $image)
                            <div style="position: relative;">
                                <img src="{{ asset('storage/' . $image->image) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 12px; border: 2px solid {{ $image->is_primary ? 'rgba(251, 191, 36, 0.5)' : 'rgba(59, 130, 246, 0.3)' }};">
                                @if($image->is_primary)
                                    <span class="badge badge-featured" style="position: absolute; top: 4px; right: 4px; font-size: 0.65rem;">Primary</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Replace Primary Image</label>
                    <div class="position-relative">
                        <input type="file" name="primary_image" class="input-dark input-custom" accept="image/*">
                        <i class="fas fa-image input-icon"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Add More Images</label>
                    <div class="position-relative">
                        <input type="file" name="images[]" class="input-dark input-custom" accept="image/*" multiple>
                        <i class="fas fa-images input-icon"></i>
                    </div>
                    <small class="text-muted">You can select multiple images</small>
                </div>
            </div>

            <!-- Section 6: Description -->
            <div class="permission-title">Description</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Description (English)</label>
                    <textarea name="description_en" class="input-dark input-custom" rows="3" placeholder="Product description in English...">{{ old('description_en', $product->description_en) }}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Description (Bengali)</label>
                    <textarea name="description_bn" class="input-dark input-custom" rows="3" placeholder="বাংলায পণ্যের বিবরণ...">{{ old('description_bn', $product->description_bn) }}</textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.ecommerce.products.index') }}" class="btn-outline btn-reset" style="text-decoration: none; padding: 0.75rem 2rem; border-radius: 100px; display: inline-flex; align-items: center;">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn-gradient btn-create" style="padding: 0.75rem 2rem; border-radius: 100px;">
                    <i class="fas fa-save me-2"></i>Update Product
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

    textarea.input-dark {
        padding-top: 0.75rem;
        resize: vertical;
    }

    select.input-dark + .input-icon,
    textarea.input-dark + .input-icon {
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
