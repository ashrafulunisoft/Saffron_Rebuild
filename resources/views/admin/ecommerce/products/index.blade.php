@extends('layouts.admin')

@section('title', 'Products - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Products <span class="text-white">পণ্য</span></h2>
        <p class="text-white mb-0">Manage product inventory with bilingual support</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.products.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus me-2"></i> Add Product
        </a>
    </div>
</div>

<div class="glass-card">
    <!-- Search and Filter -->
    <div class="row mb-4 p-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-dark text-white border-secondary">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="productSearch" class="form-control bg-dark text-white border-secondary" placeholder="Search products... / পণ্য খুঁজুন..." style="color: white;">
            </div>
            <style>
                #productSearch::placeholder {
                    color: #adb5bd !important;
                    opacity: 1 !important;
                }
                #productSearch::-webkit-input-placeholder {
                    color: #adb5bd !important;
                }
                #productSearch::-moz-placeholder {
                    color: #adb5bd !important;
                    opacity: 1 !important;
                }
            </style>
        </div>
        <div class="col-md-6 text-end">
            <select class="form-select bg-dark text-white border-secondary d-inline-block" id="categoryFilter" style="width: auto;">
                <option value="">All Categories / সকল ক্যাটাগরি</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name_en }} / {{ $category->name_bn }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Products Table -->
    <div class="table-responsive p-4">
        <table class="table table-hover table-dark" id="productsTable" style="background: transparent !important;">
            <thead class="table-dark">
                <tr>
                    <th class="text-white" style="border-color: #495057 !important;">Product (EN) / পণ্য (বাংলা)</th>
                    <th class="text-white" style="border-color: #495057 !important;">SKU</th>
                    <th class="text-white" style="border-color: #495057 !important;">Price</th>
                    <th class="text-white" style="border-color: #495057 !important;">Stock</th>
                    <th class="text-white" style="border-color: #495057 !important;">Category</th>
                    <th class="text-white" style="border-color: #495057 !important;">Status</th>
                    <th class="text-white" style="border-color: #495057 !important;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr style="border-color: #495057 !important;">
                        <td>
                            <div class="d-flex align-items-center">
                                @if($product->is_featured)
                                    <span class="badge bg-warning me-2"><i class="fas fa-star"></i></span>
                                @endif
                                <div>
                                    <div class="fw-bold text-white">{{ $product->name_en }}</div>
                                    <small class="text-info">{{ $product->name_bn }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <code class="text-warning">{{ $product->sku }}</code>
                        </td>
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
                            @if($product->category)
                                <span class="badge bg-secondary">{{ $product->category->name_en }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="badge bg-success">Active / সক্রিয়</span>
                            @else
                                <span class="badge bg-danger">Inactive / নিষ্ক্রিয়</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.ecommerce.products.show', $product) }}"
                                   class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.products.edit', $product) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="toggleFeaturedStatus({{ $product->id }})"
                                        class="btn btn-sm @if($product->is_featured) btn-warning @else btn-secondary @endif"
                                        title="Toggle Featured">
                                    <i class="fas fa-star"></i>
                                </button>
                                <button onclick="toggleProductStatus({{ $product->id }})"
                                        class="btn btn-sm @if($product->is_active) btn-warning @else btn-success @endif"
                                        title="Toggle Status">
                                    <i class="fas fa-power-off"></i>
                                </button>
                                <button onclick="deleteProduct({{ $product->id }}, '{{ $product->name_en }}')"
                                        class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-box-open fs-1 mb-3 d-block"></i>
                                <p class="text-white">No products found / কোন পণ্য পাওয়া যায়নি</p>
                                <a href="{{ route('admin.ecommerce.products.create') }}" class="btn btn-gradient mt-3">
                                    Create First Product
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center p-4">
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
    @endif
</div>

<script>
function toggleFeaturedStatus(productId) {
    if (!confirm('Are you sure you want to toggle this product featured status? / আপনি কি এই পণ্যের বৈশিষ্ট্য স্থিতি পরিবর্তন করতে চান?')) {
        return;
    }

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
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong.'
        });
    });
}

function toggleProductStatus(productId) {
    if (!confirm('Are you sure you want to toggle this product status? / আপনি কি এই পণ্যর স্থিতি পরিবর্তন করতে চান?')) {
        return;
    }

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
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong.'
        });
    });
}

function deleteProduct(productId, productName) {
    Swal.fire({
        title: 'Are you sure?',
        html: `You want to delete <strong>${productName}</strong> product?<br>আপনি কি <strong>${productName}</strong> পণ্য মুছে ফেলতে চান?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#3b82f6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/ecommerce/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || !data.error) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Product has been deleted.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Cannot delete this product.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong.'
                });
            });
        }
    });
}

// Search functionality
document.getElementById('productSearch')?.addEventListener('keyup', function(e) {
    const searchValue = e.target.value.toLowerCase();
    const table = document.getElementById('productsTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const nameEn = rows[i].getElementsByTagName('td')[0]?.textContent.toLowerCase() || '';
        const sku = rows[i].getElementsByTagName('td')[1]?.textContent.toLowerCase() || '';

        if (nameEn.includes(searchValue) || sku.includes(searchValue)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>
@endsection
