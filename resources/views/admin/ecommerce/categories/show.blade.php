@extends('layouts.admin')

@section('title', 'Category Details - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">{{ $category->name_en }} <span class="text-muted">{{ $category->name_bn }}</span></h2>
        <p class="text-muted mb-0">Category details and products</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.categories.edit', $category) }}" class="btn btn-gradient">
            <i class="fas fa-edit me-2"></i> Edit Category
        </a>
        <a href="{{ route('admin.ecommerce.categories.index') }}" class="btn btn-outline ms-2">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</div>

<!-- Category Details -->
<div class="glass-card mb-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-primary border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-info-circle me-2"></i>Category Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-5"><label class="text-muted">English Name:</label></div>
                        <div class="col-sm-7"><span class="fw-bold text-white">{{ $category->name_en }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5"><label class="text-muted">Bengali Name:</label></div>
                        <div class="col-sm-7"><span class="fw-bold text-white">{{ $category->name_bn }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5"><label class="text-muted">Slug:</label></div>
                        <div class="col-sm-7"><code class="text-warning">{{ $category->slug }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5"><label class="text-muted">Parent Category:</label></div>
                        <div class="col-sm-7">
                            @if($category->parent)
                                <span class="badge bg-secondary">{{ $category->parent->name_en }}</span>
                            @else
                                <span class="text-muted">None (Root Category)</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5"><label class="text-muted">Status:</label></div>
                        <div class="col-sm-7">
                            @if($category->is_active)
                                <span class="badge bg-success">Active / সক্রিয়</span>
                            @else
                                <span class="badge bg-danger">Inactive / নিষ্ক্রিয়</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5"><label class="text-muted">Created:</label></div>
                        <div class="col-sm-7"><span class="text-white">{{ $category->created_at->format('M d, Y h:i A') }}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5"><label class="text-muted">Updated:</label></div>
                        <div class="col-sm-7"><span class="text-white">{{ $category->updated_at->format('M d, Y h:i A') }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-success border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-chart-bar me-2"></i>Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card bg-secondary border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-box text-white fs-1 mb-2"></i>
                                    <h3 class="fw-bold text-white mb-0">{{ $category->products()->count() }}</h3>
                                    <small class="text-white-50">Products</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-info border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-folder text-white fs-1 mb-2"></i>
                                    <h3 class="fw-bold text-white mb-0">{{ $category->children()->count() }}</h3>
                                    <small class="text-white-50">Subcategories</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Subcategories -->
@if($category->children()->count() > 0)
<div class="glass-card mb-4">
    <div class="card-header bg-warning border-secondary">
        <h5 class="mb-0 text-white"><i class="fas fa-sitemap me-2"></i>Subcategories ({{ $category->children()->count() }})</h5>
    </div>
    <div class="card-body bg-dark">
        <div class="row">
            @foreach($category->children()->take(6) as $child)
                <div class="col-md-4 mb-3">
                    <div class="card bg-secondary border-0">
                        <div class="card-body">
                            <h6 class="fw-bold text-white mb-1">{{ $child->name_en }}</h6>
                            <small class="text-white-50 mb-2 d-block">{{ $child->name_bn }}</small>
                            <span class="badge bg-primary">{{ $child->products()->count() }} products</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Recent Products -->
<div class="glass-card">
    <div class="card-header bg-info border-secondary">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white"><i class="fas fa-box me-2"></i>Recent Products in this Category</h5>
            @if($category->products()->count() > 10)
                <a href="#" class="btn btn-sm btn-light">View All</a>
            @endif
        </div>
    </div>
    <div class="card-body bg-dark">
        @if($category->products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th class="text-white">Product</th>
                            <th class="text-white">SKU</th>
                            <th class="text-white">Price</th>
                            <th class="text-white">Stock</th>
                            <th class="text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->products->take(10) as $product)
                            <tr>
                                <td>
                                    <div class="fw-bold text-white">{{ $product->name_en }}</div>
                                    <small class="text-info">{{ $product->name_bn }}</small>
                                </td>
                                <td><code class="text-warning">{{ $product->sku }}</code></td>
                                <td>
                                    <span class="text-white">৳{{ number_format($product->price, 2) }}</span>
                                    @if($product->sale_price)
                                        <br><small class="text-success">Sale: ৳{{ number_format($product->sale_price, 2) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge @if($product->stock > 10) bg-success @elseif($product->stock > 0) bg-warning @else bg-danger @endif">
                                        {{ $product->stock }} in stock
                                    </span>
                                </td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-box-open text-muted fs-1 mb-3 d-block"></i>
                <p class="text-white">No products in this category yet.</p>
            </div>
        @endif
    </div>
</div>

@endsection
