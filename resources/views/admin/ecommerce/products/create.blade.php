@extends('layouts.admin')

@section('title', 'Create Product - Saffron Admin')

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
            <h2 class="fw-800 mb-0 text-white letter-spacing-1" style="font-size: 2rem;">Add Product</h2>
        </div>

        <form action="{{ route('admin.ecommerce.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Basic Information -->
            <div class="permission-title">Basic Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">SKU <span class="text-danger">*</span></label>
                    <input type="text" name="sku" class="input-dark input-custom" placeholder="e.g., CAKE-001" value="{{ old('sku') }}" required>
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
                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>
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
                    <input type="text" name="name_en" class="input-dark input-custom" placeholder="e.g., Chocolate Cake" value="{{ old('name_en') }}" required autofocus>
                    @error('name_en')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Product Name (Bengali) <span class="text-danger">*</span></label>
                    <input type="text" name="name_bn" class="input-dark input-custom" placeholder="উদাহরণ: চকোলেট কেক" value="{{ old('name_bn') }}" required>
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
                    <input type="number" name="price" class="input-dark input-custom" placeholder="0.00" step="0.01" min="0" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sale Price (৳)</label>
                    <input type="number" name="sale_price" class="input-dark input-custom" placeholder="0.00" step="0.01" min="0" value="{{ old('sale_price') }}">
                    <small class="text-muted">Leave empty if no sale</small>
                </div>
            </div>

            <!-- Section 3: Inventory -->
            <div class="permission-title">Inventory & Status</div>
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="input-dark input-custom" placeholder="0" min="0" value="{{ old('stock', 0) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" name="weight" class="input-dark input-custom" placeholder="0.00" step="0.01" min="0" value="{{ old('weight') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <div class="position-relative">
                        <select name="is_active" class="input-dark input-custom">
                            <option value="1" @if(old('is_active', '1') === '1') selected @endif>Active</option>
                            <option value="0" @if(old('is_active') === '0') selected @endif>Inactive</option>
                        </select>
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
                                <option value="{{ $tag->id }}" @if(old('tags.*') && in_array($tag->id, old('tags') ?? [])) selected @endif>
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
                    <label class="form-label">Primary Image <span class="text-danger">*</span></label>
                    <input type="file" name="primary_image" class="input-dark input-custom" accept="image/*" required>
                    @error('primary_image')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Additional Images</label>
                    <input type="file" name="images[]" class="input-dark input-custom" accept="image/*" multiple>
                    <small class="text-muted">You can select multiple images</small>
                </div>
            </div>

            <!-- Section 6: Description -->
            <div class="permission-title">Description</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Description (English)</label>
                    <textarea name="description_en" class="input-dark input-custom" rows="3" placeholder="Product description in English...">{{ old('description_en') }}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Description (Bengali)</label>
                    <textarea name="description_bn" class="input-dark input-custom" rows="3" placeholder="বাংলায পণ্যের বিবরণ...">{{ old('description_bn') }}</textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.ecommerce.products.index') }}" class="btn-outline btn-reset" style="text-decoration: none; padding: 0.75rem 2rem; border-radius: 100px; display: inline-flex; align-items: center;">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn-gradient btn-create" style="padding: 0.75rem 2rem; border-radius: 100px;">
                    <i class="fas fa-check-circle me-2"></i>Create Product
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

    .text-shadow-white {
        text-shadow: 0 2px 10px rgba(255, 255, 255, 0.3);
    }

    .role-container {
        margin: 0 auto;
    }
</style>
@endpush
@endsection
