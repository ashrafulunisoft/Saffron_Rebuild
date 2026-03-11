@extends('layouts.admin')

@section('title', 'Categories - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Categories <span class="text-white">ক্যাটাগরি</span></h2>
        <p class="text-white mb-0">Manage product categories with bilingual support</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.categories.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus me-2"></i> Add Category
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
                <input type="text" id="categorySearch" class="form-control bg-dark text-white border-secondary" placeholder="Search categories... / ক্যাটাগরি খুঁজুন..." style="color: white;">
            </div>
            <style>
                #categorySearch::placeholder {
                    color: #adb5bd !important;
                    opacity: 1 !important;
                }
                #categorySearch::-webkit-input-placeholder {
                    color: #adb5bd !important;
                }
                #categorySearch::-moz-placeholder {
                    color: #adb5bd !important;
                    opacity: 1 !important;
                }
            </style>
        </div>
        <div class="col-md-6 text-end">
            <select class="form-select bg-dark text-white border-secondary d-inline-block" id="parentFilter" style="width: auto;">
                <option value="">All Categories / সকল ক্যাটাগরি</option>
                @foreach($parentCategories as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name_en }} / {{ $parent->name_bn }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="table-responsive p-4">
        <table class="table table-hover table-dark" id="categoriesTable" style="background: transparent !important;">
            <thead class="table-dark">
                <tr>
                    <th class="text-white" style="border-color: #495057 !important;">Name (EN) / নাম (বাংলা)</th>
                    <th class="text-white" style="border-color: #495057 !important;">Slug</th>
                    <th class="text-white" style="border-color: #495057 !important;">Parent</th>
                    <th class="text-white" style="border-color: #495057 !important;">Products</th>
                    <th class="text-white" style="border-color: #495057 !important;">Status</th>
                    <th class="text-white" style="border-color: #495057 !important;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr style="border-color: #495057 !important;">
                        <td>
                            <div class="fw-bold text-white">{{ $category->name_en }}</div>
                            <small class="text-info">{{ $category->name_bn }}</small>
                        </td>
                        <td>
                            <code class="text-warning">{{ $category->slug }}</code>
                        </td>
                        <td>
                            @if($category->parent)
                                <span class="badge bg-secondary">{{ $category->parent->name_en }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $category->products_count }}</span>
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Active / সক্রিয়</span>
                            @else
                                <span class="badge bg-danger">Inactive / নিষ্ক্রিয়</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.ecommerce.categories.show', $category) }}"
                                   class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.categories.edit', $category) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="toggleCategoryStatus({{ $category->id }})"
                                        class="btn btn-sm @if($category->is_active) btn-warning @else btn-success @endif"
                                        title="Toggle Status">
                                    <i class="fas fa-power-off"></i>
                                </button>
                                <button onclick="deleteCategory({{ $category->id }}, '{{ $category->name_en }}')"
                                        class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-folder-open fs-1 mb-3 d-block"></i>
                                <p class="text-white">No categories found / কোন ক্যাটাগরি পাওয়া যায়নি</p>
                                <a href="{{ route('admin.ecommerce.categories.create') }}" class="btn btn-gradient mt-3">
                                    Create First Category
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->appends(['search' => request('search')])->links() }}
        </div>
    @endif
</div>

<script>
function toggleCategoryStatus(categoryId) {
    if (!confirm('Are you sure you want to toggle this category status? / আপনি কি এই ক্যাটাগরির স্থিতি পরিবর্তন করতে চান?')) {
        return;
    }

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

function deleteCategory(categoryId, categoryName) {
    Swal.fire({
        title: 'Are you sure?',
        html: `You want to delete <strong>${categoryName}</strong> category?<br>আপনি কি <strong>${categoryName}</strong> ক্যাটাগরি মুছে ফেলতে চান?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#3b82f6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ route('admin.ecommerce.categories.index') }}/${categoryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Category has been deleted.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Cannot delete this category.'
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
document.getElementById('categorySearch')?.addEventListener('keyup', function(e) {
    const searchValue = e.target.value.toLowerCase();
    const table = document.getElementById('categoriesTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const nameEn = rows[i].getElementsByTagName('td')[0]?.textContent.toLowerCase() || '';
        const nameBn = rows[i].getElementsByTagName('td')[0]?.textContent.toLowerCase() || '';

        if (nameEn.includes(searchValue) || nameBn.includes(searchValue)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>
@endsection
