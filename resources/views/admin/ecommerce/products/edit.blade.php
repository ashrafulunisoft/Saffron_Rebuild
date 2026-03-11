@extends('layouts.admin')

@section('title', 'Edit Product - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Edit Product <span class="text-white">পণ্য সম্পাদনা করুন</span></h2>
        <p class="text-white mb-0">Update product information</p>
    </div>
    <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left me-2"></i> Back to Products
    </a>
</div>

<div class="glass-card-dark" style="max-width: 900px; margin: 0 auto;">
    <form action="{{ route('admin.ecommerce.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

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
                           value="{{ old('sku', $product->sku) }}"
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
                           value="{{ old('name_en', $product->name_en) }}"
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
                           value="{{ old('name_bn', $product->name_bn) }}"
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
                                    @if(old('category_id', $product->category_id) == $category->id) selected @endif>
                                {{ $category->name_en }} / {{ $category->name_bn }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
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
                              placeholder="Product description in English...">{{ old('description_en', $product->description_en) }}</textarea>
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
                              placeholder="বাংলায় পণ্যের বর্ণনা...">{{ old('description_bn', $product->description_bn) }}</textarea>
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
                               value="{{ old('price', $product->price) }}"
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
                               value="{{ old('sale_price', $product->sale_price) }}">
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
                               value="{{ old('stock', $product->stock) }}"
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
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="isFeatured" @if(old('is_featured', $product->is_featured)) checked @endif>
                        <label class="form-check-label text-white" for="isFeatured">
                            <strong>Featured Product / বৈশিষ্ট্যপূর্ণ পণ্য</strong>
                            <small class="d-block text-muted">Show on homepage and featured sections</small>
                        </label>
                    </div>
                </div>

                <!-- Active -->
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" @if(old('is_active', $product->is_active)) checked @endif>
                        <label class="form-check-label text-white" for="isActive">
                            <strong>Active / সক্রিয়</strong>
                            <small class="d-block text-muted">Show this product on the website</small>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-warning border-secondary">
                <h6 class="mb-0 text-white"><i class="fas fa-info-circle me-2"></i>Current Product Info</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Current Slug:</label>
                        <div><code class="text-warning">{{ $product->slug }}</code></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small">Total Orders:</label>
                        <div><span class="badge bg-primary">{{ $product->orderItems()->count() }}</span></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Created:</label>
                        <div class="text-white">{{ $product->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Updated:</label>
                        <div class="text-white">{{ $product->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Update Product / আপডেট করুন
            </button>
            <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
