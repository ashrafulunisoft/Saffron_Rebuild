@extends('layouts.admin')

@section('title', 'Product Details - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">{{ $product->name_en }} <span class="text-white">{{ $product->name_bn }}</span></h2>
        <p class="text-white mb-0">Product details and information</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.products.edit', $product) }}" class="btn btn-gradient">
            <i class="fas fa-edit me-2"></i> Edit Product
        </a>
        <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-outline ms-2">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</div>

<!-- Product Details -->
<div class="glass-card mb-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-primary border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-info-circle me-2"></i>Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">SKU:</label></div>
                        <div class="col-sm-8"><code class="text-warning">{{ $product->sku }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">English Name:</label></div>
                        <div class="col-sm-8"><span class="fw-bold text-white">{{ $product->name_en }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Bengali Name:</label></div>
                        <div class="col-sm-8"><span class="fw-bold text-white">{{ $product->name_bn }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Slug:</label></div>
                        <div class="col-sm-8"><code class="text-warning">{{ $product->slug }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Category:</label></div>
                        <div class="col-sm-8">
                            @if($product->category)
                                <span class="badge bg-secondary">{{ $product->category->name_en }}</span>
                            @else
                                <span class="text-muted">None</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Description (EN):</label></div>
                        <div class="col-sm-8"><span class="text-white">{{ $product->description_en ?? 'N/A' }}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><label class="text-muted">Description (BN):</label></div>
                        <div class="col-sm-8"><span class="text-white">{{ $product->description_bn ?? 'N/A' }}</span></div>
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
                        <div class="col-6">
                            <div class="card bg-secondary border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-shopping-cart text-white fs-1 mb-2"></i>
                                    <h3 class="fw-bold text-white mb-0">{{ $product->orderItems()->count() }}</h3>
                                    <small class="text-white-50">Orders</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-info border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-eye text-white fs-1 mb-2"></i>
                                    <h3 class="fw-bold text-white mb-0">{{ $product->views }}</h3>
                                    <small class="text-white-50">Views</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pricing & Stock -->
<div class="glass-card mb-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-warning border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-tag me-2"></i>Pricing</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6"><label class="text-muted">Regular Price:</label></div>
                        <div class="col-sm-6"><span class="text-white fs-5 fw-bold">৳{{ number_format($product->price, 2) }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><label class="text-muted">Sale Price:</label></div>
                        <div class="col-sm-6">
                            @if($product->sale_price)
                                <span class="text-success fs-5 fw-bold">৳{{ number_format($product->sale_price, 2) }}</span>
                                <br><small class="text-white-50">Save: ৳{{ number_format($product->price - $product->sale_price, 2) }}</small>
                            @else
                                <span class="text-muted">No sale price</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><label class="text-muted">Current Price:</label></div>
                        <div class="col-sm-6"><span class="text-info fs-4 fw-bold">৳{{ number_format($product->getCurrentPriceAttribute(), 2) }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-info border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-warehouse me-2"></i>Inventory</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6"><label class="text-muted">Stock:</label></div>
                        <div class="col-sm-6">
                            <span class="badge @if($product->stock > 10) bg-success @elseif($product->stock > 0) bg-warning @else bg-danger @endif fs-6">
                                {{ $product->stock }} in stock
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><label class="text-muted">Status:</label></div>
                        <div class="col-sm-6">
                            @if($product->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><label class="text-muted">Featured:</label></div>
                        <div class="col-sm-6">
                            @if($product->is_featured)
                                <span class="badge bg-warning"><i class="fas fa-star"></i> Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="glass-card">
    <div class="card-header bg-info border-secondary">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white"><i class="fas fa-shopping-bag me-2"></i>Recent Orders with this Product</h5>
            @if($product->orderItems()->count() > 10)
                <a href="#" class="btn btn-sm btn-light">View All</a>
            @endif
        </div>
    </div>
    <div class="card-body bg-dark">
        @if($product->orderItems->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th class="text-white">Order ID</th>
                            <th class="text-white">Quantity</th>
                            <th class="text-white">Price</th>
                            <th class="text-white">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->orderItems->take(10) as $orderItem)
                            <tr>
                                <td><code class="text-warning">#{{ $orderItem->order_id ?? 'N/A' }}</code></td>
                                <td><span class="badge bg-primary">{{ $orderItem->quantity }}</span></td>
                                <td><span class="text-white">৳{{ number_format($orderItem->price, 2) }}</span></td>
                                <td><span class="text-white">{{ $orderItem->created_at->format('M d, Y') }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-shopping-bag text-muted fs-1 mb-3 d-block"></i>
                <p class="text-white">No orders for this product yet.</p>
            </div>
        @endif
    </div>
</div>

@endsection
