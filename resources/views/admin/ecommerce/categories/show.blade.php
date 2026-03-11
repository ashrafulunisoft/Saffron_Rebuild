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
            <h5 class="fw-bold text-white mb-3">
                <i class="fas fa-info-circle text-primary"></i> Category Information
            </h5>
            <table class="table table-borderless">
                <tr>
                    <td width="40%" class="text-muted">English Name:</td>
                    <td class="fw-bold text-white">{{ $category->name_en }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Bengali Name:</td>
                    <td class="fw-bold text-white">{{ $category->name_bn }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Slug:</td>
                    <td><code class="text-info">{{ $category->slug }}</code></td>
                </tr>
                <tr>
                    <td class="text-muted">Parent Category:</td>
                    <td>
                        @if($category->parent)
                            <span class="badge bg-secondary">{{ $category->parent->name_en }}</span>
                        @else
                            <span class="text-muted">None (Root Category)</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Status:</td>
                    <td>
                        @if($category->is_active)
                            <span class="badge bg-success">Active / সক্রিয়</span>
                        @else
                            <span class="badge bg-danger">Inactive / নিষ্ক্রিয়</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Created:</td>
                    <td class="text-white">{{ $category->created_at->format('M d, Y h:i A') }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Updated:</td>
                    <td class="text-white">{{ $category->updated_at->format('M d, Y h:i A') }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h5 class="fw-bold text-white mb-3">
                <i class="fas fa-chart-bar text-success"></i> Statistics
            </h5>
            <div class="row g-3">
                <div class="col-6">
                    <div class="summary-card glass-card p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="text-muted small">Products</div>
                                <h2 class="fw-bold text-white mb-0">{{ $category->products()->count() }}</h2>
                            </div>
                            <div class="summary-icon">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="summary-card glass-card p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="text-muted small">Subcategories</div>
                                <h2 class="fw-bold text-white mb-0">{{ $category->children()->count() }}</h2>
                            </div>
                            <div class="summary-icon">
                                <i class="fas fa-folder"></i>
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
    <h5 class="fw-bold text-white mb-3">
        <i class="fas fa-sitemap text-warning"></i> Subcategories ({{ $category->children()->count() }})
    </h5>
    <div class="row">
        @foreach($category->children()->take(6) as $child)
            <div class="col-md-4 mb-3">
                <div class="glass-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold text-white">{{ $child->name_en }}</div>
                            <small class="text-muted">{{ $child->name_bn }}</small>
                        </div>
                        <span class="badge bg-primary">{{ $child->products()->count() }} products</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- Recent Products -->
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-white mb-0">
            <i class="fas fa-box text-info"></i> Recent Products in this Category
        </h5>
        @if($category->products()->count() > 10)
            <a href="#" class="btn btn-sm btn-outline">View All</a>
        @endif
    </div>

    @if($category->products->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->products->take(10) as $product)
                        <tr>
                            <td>
                                <div class="fw-bold text-white">{{ $product->name_en }}</div>
                                <small class="text-muted">{{ $product->name_bn }}</small>
                            </td>
                            <td><code class="text-info">{{ $product->sku }}</code></td>
                            <td>
                                ৳{{ number_format($product->price, 2) }}
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
            <p class="text-muted">No products in this category yet.</p>
        </div>
    @endif
</div>

@endsection
