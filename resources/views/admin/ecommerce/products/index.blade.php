@extends('layouts.admin')

@section('title', 'Products - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">PRODUCT MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Products</h2>
                <a href="{{ route('admin.ecommerce.products.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-plus me-2"></i>Add Product
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Products</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalProducts }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-box" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Active</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $activeProducts }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(34, 197, 94, 0.2);">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Featured</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $featuredProducts }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-star" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Low Stock</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $lowStock }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.2);">
                            <i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <form id="filterForm" action="{{ route('admin.ecommerce.products.index') }}" method="GET">
            <div class="row g-3 mb-4" style="background: rgba(15, 23, 42, 0.6); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <input type="text" name="search" id="productSearch" class="input-dark input-custom" placeholder="Search products..." style="color: white;" value="{{ request('search') }}">
                        <button type="submit" class="btn-gradient" style="padding: 0.6rem 1.2rem; border-radius: 10px; white-space: nowrap;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="input-dark input-custom" name="category" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name_en }} / {{ $category->name_bn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="input-dark input-custom" name="status" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="featured" {{ request('featured') ? 'selected' : '' }}>Featured Only</option>
                    </select>
                </div>
            </div>
        </form>

        <!-- Products Table -->
        <div class="table-responsive">
            <table class="table-custom" id="productsTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Status</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr>
                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}</td>
                        <td>
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image) }}"
                                     alt="{{ $product->name_en }}"
                                     class="product-img">
                            @elseif($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                     alt="{{ $product->name_en }}"
                                     class="product-img">
                            @else
                                <div class="product-img-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($product->is_featured)
                                    <span class="badge badge-featured"><i class="fas fa-star"></i></span>
                                @endif
                                <div>
                                    <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $product->name_en }}</div>
                                    <div style="font-size: 0.75rem; opacity: 0.6;">{{ $product->name_bn }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <code style="font-size: 0.85rem;">{{ $product->sku }}</code>
                        </td>
                        <td>
                            <div style="font-size: 0.9rem;">৳{{ number_format($product->price, 2) }}</div>
                            @if($product->sale_price)
                                <div style="font-size: 0.75rem; color: #22c55e;">Sale: ৳{{ number_format($product->sale_price, 2) }}</div>
                            @endif
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
                            @if($product->category)
                                <span class="badge badge-visit-type">{{ $product->category->name_en }}</span>
                            @else
                                <span style="opacity: 0.5;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($product->tags->count() > 0)
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($product->tags->take(2) as $tag)
                                        <span class="badge" style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); font-size: 0.7rem;">{{ $tag->name_en }}</span>
                                    @endforeach
                                    @if($product->tags->count() > 2)
                                        <span class="badge" style="background: rgba(107, 114, 128, 0.2); color: #94a3b8; font-size: 0.7rem;">+{{ $product->tags->count() - 2 }}</span>
                                    @endif
                                </div>
                            @else
                                <span style="opacity: 0.5;">-</span>
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
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.products.show', $product) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.products.edit', $product) }}" class="action-btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="toggleFeaturedStatus({{ $product->id }})" class="action-btn @if($product->is_featured) 'btn-featured' @else 'btn-inactive' @endif" title="Toggle Featured">
                                    <i class="fas fa-star"></i>
                                </button>
                                <button onclick="toggleProductStatus({{ $product->id }})" class="action-btn @if($product->is_active) 'btn-warning-action' @else 'btn-approve' @endif" title="Toggle Status">
                                    <i class="fas fa-power-off"></i>
                                </button>
                                <button onclick="deleteProduct({{ $product->id }}, '{{ $product->name_en }}')" class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5">
                            <i class="fas fa-box-open" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No products found</div>
                            <a href="{{ route('admin.ecommerce.products.create') }}" class="btn-gradient" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                                <i class="fas fa-plus me-2"></i>Add Your First Product
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                Showing {{ ($products->currentPage() - 1) * $products->perPage() + 1 }}
                to {{ min($products->currentPage() * $products->perPage(), $products->total()) }}
                of {{ $products->total() }} products
            </div>
            {{ $products->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Handle filter form submission
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const productSearch = document.getElementById('productSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const statusFilter = document.getElementById('statusFilter');

    // Submit on Enter key in search
    productSearch.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterForm.submit();
        }
    });

    // Auto-submit on category change
    categoryFilter.addEventListener('change', function() {
        filterForm.submit();
    });

    // Auto-submit on status change
    statusFilter.addEventListener('change', function() {
        filterForm.submit();
    });
});

function toggleFeaturedStatus(productId) {
    Swal.fire({
        title: 'Toggle Featured?',
        text: "Are you sure you want to toggle this product's featured status?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#fbbf24',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, toggle it!',
        cancelButtonText: 'Cancel',
        background: '#0f172a',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/ecommerce/products/${productId}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false,
                        background: '#0f172a',
                        color: '#fff'
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong.',
                    background: '#0f172a',
                    color: '#fff'
                });
            });
        }
    });
}

function toggleProductStatus(productId) {
    Swal.fire({
        title: 'Toggle Status?',
        text: "Are you sure you want to toggle this product's status?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, toggle it!',
        cancelButtonText: 'Cancel',
        background: '#0f172a',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/ecommerce/products/${productId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false,
                        background: '#0f172a',
                        color: '#fff'
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong.',
                    background: '#0f172a',
                    color: '#fff'
                });
            });
        }
    });
}

function deleteProduct(productId, productName) {
    Swal.fire({
        title: 'Delete Product?',
        text: `Are you sure you want to delete "${productName}"? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        background: '#0f172a',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/ecommerce/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Failed to delete product');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message || 'Product deleted successfully!',
                        confirmButtonColor: '#22c55e',
                        background: '#0f172a',
                        color: '#fff'
                    });
                    setTimeout(() => location.reload(), 1500);
                } else {
                    throw new Error(data.message || 'Delete failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Something went wrong / কিছু ভুল হয়েছে',
                    confirmButtonColor: '#ef4444',
                    background: '#0f172a',
                    color: '#fff'
                });
            });
        }
    });
}
</script>
@endpush

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    .product-img {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid rgba(59, 130, 246, 0.3);
    }

    .product-img-placeholder {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: rgba(107, 114, 128, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.3);
        border: 2px solid rgba(107, 114, 128, 0.3);
    }

    .badge-featured {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
        border: 1px solid rgba(251, 191, 36, 0.3);
        font-size: 0.7rem;
    }

    .btn-featured {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }

    .btn-featured:hover {
        background: #fbbf24;
        color: #000;
    }

    .btn-inactive {
        background: rgba(107, 114, 128, 0.2);
        color: #94a3b8;
    }

    .btn-inactive:hover {
        background: #94a3b8;
        color: #fff;
    }

    .btn-warning-action {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }

    .btn-warning-action:hover {
        background: #fbbf24;
        color: #000;
    }
</style>
@endpush
@endsection
