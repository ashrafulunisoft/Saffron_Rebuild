@extends('layouts.admin')

@section('title', "Tag - {$tag->name_en}")

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">TAG MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">{{ $tag->name_en }}</h2>
                <a href="{{ route('admin.ecommerce.tags.edit', $tag) }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn-outline" style="padding: 0.75rem 1rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>

        <!-- Tag Summary -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Tag ID</h6>
                        <div><code style="color: #fbbf24; font-size: 1.1rem;">#{{ $tag->id }}</code></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Products</h6>
                        <h3 class="text-white fw-800 mb-0">{{ $tag->products()->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Bengali Name</h6>
                        <div class="text-white fw-600" style="font-size: 1rem;">{{ $tag->name_bn }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tag Details -->
        <div class="row g-4 mb-5">
            <div class="col-md-8">
                <div class="permission-title">Tag Information</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">ENGLISH NAME</label>
                            <div class="text-white fw-600" style="font-size: 0.95rem;">{{ $tag->name_en }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">BENGALI NAME</label>
                            <div style="font-size: 0.9rem; opacity: 0.8;">{{ $tag->name_bn }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">CREATED</label>
                            <div style="font-size: 0.85rem;">{{ $tag->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">LAST UPDATED</label>
                            <div style="font-size: 0.85rem;">{{ $tag->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="permission-title">Statistics</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem; text-align: center;">
                    <i class="fas fa-box" style="color: var(--accent-blue); font-size: 2.5rem; margin-bottom: 1rem;"></i>
                    <h3 class="text-white fw-800 mb-0" style="font-size: 2.5rem;">{{ $tag->products()->count() }}</h3>
                    <div style="font-size: 0.85rem; opacity: 0.6;">Products Using This Tag</div>
                </div>
            </div>
        </div>

        <!-- Products with this tag -->
        <div class="permission-title">Products with "{{ $tag->name_en }}" Tag ({{ $tag->products->count() }})</div>
        @if($tag->products()->count() > 0)
            <div style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
                <table class="table-custom" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tag->products->take(10) as $product)
                        <tr>
                            <td>
                                <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $product->name_en }}</div>
                                <div style="font-size: 0.75rem; opacity: 0.6;">{{ $product->name_bn }}</div>
                            </td>
                            <td>
                                <code style="font-size: 0.85rem;">{{ $product->sku }}</code>
                            </td>
                            <td>
                                <div style="font-size: 0.9rem;">৳{{ number_format($product->price, 2) }}</div>
                            </td>
                            <td>
                                @if($product->stock > 10)
                                    <span class="badge badge-approved">{{ $product->stock }} in stock</span>
                                @elseif($product->stock > 0)
                                    <span class="badge badge-pending">Low: {{ $product->stock }}</span>
                                @else
                                    <span class="badge badge-cancelled">Out of stock</span>
                                @endif
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge badge-approved">Active</span>
                                @else
                                    <span class="badge badge-cancelled">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.ecommerce.products.show', $product) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($tag->products()->count() > 10)
                <div class="text-center mt-4">
                    <a href="{{ route('admin.ecommerce.products.index') }}" class="btn-outline" style="padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                        View All Products
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-5" style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
                <i class="fas fa-box-open" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                <div class="text-white" style="opacity: 0.5;">No products with this tag yet</div>
                <div style="font-size: 0.85rem; opacity: 0.5; margin-top: 0.5rem;">Products with this tag will appear here</div>
            </div>
        @endif
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')
@endpush
@endsection
