@extends('layouts.admin')

@section('title', 'Categories - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">CATEGORY MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Categories</h2>
                <a href="{{ route('admin.ecommerce.categories.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                    <i class="fas fa-plus me-2"></i>Add Category
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Categories</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalCategories }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-folder" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Active</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $activeCategories }}</h3>
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
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Root Categories</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $rootCategories }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2);">
                            <i class="fas fa-sitemap" style="color: #a855f7;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">With Products</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $categoriesWithProducts }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-box" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section row g-3 mb-4" style="background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(20px); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08); transition: all 0.3s ease; position: relative; overflow: hidden;">
            <div class="col-md-6">
                <div class="position-relative">
                    <input type="text" id="categorySearch" class="input-dark input-custom" placeholder="Search categories..." style="color: white;">
                    <i class="fas fa-search input-icon"></i>
                </div>
            </div>
            <div class="col-md-6">
                <select class="input-dark input-custom" id="parentFilter">
                    <option value="">All Categories</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name_en }} / {{ $parent->name_bn }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="table-responsive">
            <table class="table-custom" id="categoriesTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $category->name_en }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.6;">{{ $category->name_bn }}</div>
                        </td>
                        <td>
                            <code style="font-size: 0.85rem;">{{ $category->slug }}</code>
                        </td>
                        <td>
                            @if($category->parent)
                                <span class="badge badge-visit-type">{{ $category->parent->name_en }}</span>
                            @else
                                <span style="opacity: 0.5;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($category->products_count > 0)
                                <span class="badge badge-completed">{{ $category->products_count }} products</span>
                            @else
                                <span style="opacity: 0.5;">0</span>
                            @endif
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge badge-approved">Active</span>
                            @else
                                <span class="badge badge-cancelled">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.categories.show', $category) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.categories.edit', $category) }}" class="action-btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="toggleCategoryStatus({{ $category->id }})" class="action-btn @if($category->is_active) 'btn-warning-action' @else 'btn-approve' @endif" title="Toggle Status">
                                    <i class="fas fa-power-off"></i>
                                </button>
                                <button onclick="deleteCategory({{ $category->id }}, '{{ $category->name_en }}')" class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-folder-open" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No categories found</div>
                            <a href="{{ route('admin.ecommerce.categories.create') }}" class="btn-gradient" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                                <i class="fas fa-plus me-2"></i>Add Your First Category
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                Showing {{ ($categories->currentPage() - 1) * $categories->perPage() + 1 }}
                to {{ min($categories->currentPage() * $categories->perPage(), $categories->total()) }}
                of {{ $categories->total() }} categories
            </div>
            {{ $categories->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function toggleCategoryStatus(categoryId) {
    Swal.fire({
        title: 'Toggle Status?',
        text: "Are you sure you want to toggle this category's status?",
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
            fetch(`/admin/ecommerce/categories/${categoryId}/toggle`, {
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

function deleteCategory(categoryId, categoryName) {
    Swal.fire({
        title: 'Delete Category?',
        text: `Are you sure you want to delete "${categoryName}"? This action cannot be undone.`,
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
            window.location.href = `/admin/ecommerce/categories/${categoryId}`;
        }
    });
}
</script>
@endpush

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    /* Fade In Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-warning-action {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }

    .btn-warning-action:hover {
        background: #fbbf24;
        color: #000;
    }

    /* Enhanced Button Glow Effects */
    .btn-gradient {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-gradient:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4),
                    0 0 40px rgba(59, 130, 246, 0.2),
                    inset 0 0 20px rgba(255, 255, 255, 0.1);
    }

    /* Table Row Animations */
    .table-custom tbody tr {
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .table-custom tbody tr:nth-child(1) { animation-delay: 0.05s; }
    .table-custom tbody tr:nth-child(2) { animation-delay: 0.1s; }
    .table-custom tbody tr:nth-child(3) { animation-delay: 0.15s; }
    .table-custom tbody tr:nth-child(4) { animation-delay: 0.2s; }
    .table-custom tbody tr:nth-child(5) { animation-delay: 0.25s; }
    .table-custom tbody tr:nth-child(n+6) { animation-delay: 0.3s; }

    .table-custom tbody tr:hover {
        background: rgba(59, 130, 246, 0.15) !important;
        transform: scale(1.01);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.2);
    }

    /* Action Button Glow */
    .action-btn {
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: scale(1.15);
        box-shadow: 0 4px 15px currentColor;
    }

    /* Stat Card Enhancements */
    .stat-card {
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            45deg,
            transparent,
            rgba(59, 130, 246, 0.05),
            transparent
        );
        transform: rotate(45deg);
        transition: all 0.6s ease;
        opacity: 0;
    }

    .stat-card:hover::after {
        opacity: 1;
        animation: shine 1s ease;
    }

    @keyframes shine {
        0% {
            top: -50%;
            right: -50%;
        }
        100% {
            top: 150%;
            right: 150%;
        }
    }

    .stat-icon {
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.15);
        box-shadow: 0 8px 25px currentColor;
    }

    /* Filter Section */
    .input-dark {
        transition: all 0.3s ease;
    }

    .input-dark:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3),
                    0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    /* Filter Section Hover */
    .filter-section:hover {
        border-color: rgba(59, 130, 246, 0.3);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.15),
                    0 0 20px rgba(59, 130, 246, 0.1);
    }

    /* Badge Glow */
    .badge {
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 15px currentColor;
    }
</style>
@endpush
@endsection
