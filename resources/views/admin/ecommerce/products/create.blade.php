@extends('layouts.admin')

@section('title', 'Create Product - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Create Product <span class="text-white">পণ্য তৈরি করুন</span></h2>
        <p class="text-white mb-0">Add a new product with bilingual support</p>
    </div>
    <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left me-2"></i> Back to Products
    </a>
</div>

<div class="glass-card-dark" style="max-width: 900px; margin: 0 auto;">
    <form action="{{ route('admin.ecommerce.products.store') }}" method="POST">
        @csrf

        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-secondary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-box text-primary me-2"></i>Product Information</h5>
            </div>
            <div class="card-body">
                <!-- SKU -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        SKU <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="sku"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="e.g., CAKE-001"
                           value="{{ old('sku') }}"
                           required>
                    @error('sku')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- English Name -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Product Name (English) <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name_en"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="e.g., Chocolate Cake"
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
                        Product Name (Bengali) <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name_bn"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="উদাহরণ: চকোলেট কেক"
                           value="{{ old('name_bn') }}"
                           required>
                    @error('name_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Category <span class="text-danger">*</span>
                    </label>
                    <select name="category_id" class="form-select bg-dark text-white border-secondary" required>
                        <option value="">Select Category / ক্যাটাগরি নির্বাচন করুন</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if(old('category_id') == $category->id) selected @endif>
                                {{ $category->name_en }} / {{ $category->name_bn }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Tags <span class="text-info">(Optional)</span>
                    </label>
                    <select name="tags[]" class="form-select bg-dark text-white border-secondary" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name_en }} / {{ $tag->name_bn }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl/Cmd to select multiple tags</small>
                    @error('tags')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- English Description -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Description (English)
                    </label>
                    <textarea name="description_en"
                              class="form-control bg-dark text-white border-secondary"
                              rows="3"
                              placeholder="Product description in English...">{{ old('description_en') }}</textarea>
                    @error('description_en')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bengali Description -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Description (Bengali)
                    </label>
                    <textarea name="description_bn"
                              class="form-control bg-dark text-white border-secondary"
                              rows="3"
                              placeholder="বাংলায় পণ্যের বর্ণনা...">{{ old('description_bn') }}</textarea>
                    @error('description_bn')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-success border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-tag text-success me-2"></i>Pricing & Inventory</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Price -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">
                            Price (৳) <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                               name="price"
                               class="form-control bg-dark text-white border-secondary"
                               placeholder="0.00"
                               step="0.01"
                               min="0"
                               value="{{ old('price') }}"
                               required>
                        @error('price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sale Price -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">
                            Sale Price (৳)
                        </label>
                        <input type="number"
                               name="sale_price"
                               class="form-control bg-dark text-white border-secondary"
                               placeholder="0.00"
                               step="0.01"
                               min="0"
                               value="{{ old('sale_price') }}">
                        @error('sale_price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">
                            Stock Quantity <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                               name="stock"
                               class="form-control bg-dark text-white border-secondary"
                               placeholder="0"
                               min="0"
                               value="{{ old('stock') }}"
                               required>
                        @error('stock')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-info border-secondary">
                <h6 class="mb-0 text-white"><i class="fas fa-cog me-2"></i>Product Settings</h6>
            </div>
            <div class="card-body">
                <!-- Featured -->
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="isFeatured">
                        <label class="form-check-label text-white" for="isFeatured">
                            <strong>Featured Product / বৈশিষ্ট্যপূর্ণ পণ্য</strong>
                            <small class="d-block text-muted">Show on homepage and featured sections</small>
                        </label>
                    </div>
                </div>

                <!-- Active -->
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" checked>
                        <label class="form-check-label text-white" for="isActive">
                            <strong>Active / সক্রিয়</strong>
                            <small class="d-block text-muted">Show this product on the website</small>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Gallery - Note: Images will be uploaded after creating the product -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-info border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-info-circle me-2"></i>Product Images</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info border-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Important:</strong> Please save the product first, then you can upload images from the edit page.
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Save Product / সংরক্ষণ করুন
            </button>
            <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
