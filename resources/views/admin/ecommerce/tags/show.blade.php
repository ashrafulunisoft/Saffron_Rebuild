@extends('layouts.admin')

@section('title', 'Tag Details - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">{{ $tag->name_en }} <span class="text-white">{{ $tag->name_bn }}</span></h2>
        <p class="text-white mb-0">Tag details and products</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.tags.edit', $tag) }}" class="btn btn-gradient">
            <i class="fas fa-edit me-2"></i> Edit Tag
        </a>
        <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn btn-outline ms-2">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</div>

<!-- Tag Details -->
<div class="glass-card mb-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-primary border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-tag me-2"></i>Tag Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Tag ID:</label></div>
                        <div class="col-sm-8"><code class="text-warning">#{{ $tag->id }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">English Name:</label></div>
                        <div class="col-sm-8"><span class="fw-bold text-white">{{ $tag->name_en }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Bengali Name:</label></div>
                        <div class="col-sm-8"><span class="fw-bold text-white">{{ $tag->name_bn }}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><label class="text-muted">Created:</label></div>
                        <div class="col-sm-8"><span class="text-white">{{ $tag->created_at->format('M d, Y h:i A') }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-success border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-chart-bar me-2"></i>Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card bg-primary border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-box text-white fs-1 mb-2"></i>
                                    <h3 class="fw-bold text-white mb-0">{{ $tag->products()->count() }}</h3>
                                    <small class="text-white-50">Products Using This Tag</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products with this tag -->
<div class="glass-card">
    <div class="card-header bg-info border-secondary">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white"><i class="fas fa-shopping-bag me-2"></i>Products with "{{ $tag->name_en }}" Tag ({{ $tag->products->count() }})</h5>
            @if($tag->products()->count() > 10)
                <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-sm btn-light">View All Products</a>
            @endif
        </div>
    </div>
    <div class="card-body bg-dark">
        @if($tag->products->count() > 0)
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
                        @foreach($tag->products->take(10) as $product)
                            <tr>
                                <td>
                                    <div class="fw-bold text-white">{{ $product->name_en }}</div>
                                    <small class="text-info">{{ $product->name_bn }}</small>
                                </td>
                                <td><code class="text-warning">{{ $product->sku }}</code></td>
                                <td><span class="text-white">৳{{ number_format($product->price, 2) }}</span></td>
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
                <p class="text-white">No products with this tag yet.</p>
                <a href="{{ route('admin.ecommerce.products.create') }}" class="btn btn-gradient mt-3">
                    Add Product with Tag
                </a>
            </div>
        @endif
    </div>
</div>

@endsection
