@extends('layouts.admin')

@section('title', 'Blog Management - Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">BLOG MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Blog Posts</h2>
                <a href="{{ route('admin.ecommerce.blog.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-plus me-2"></i>Add New Post
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Posts / মোট</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $stats['total'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-newspaper" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Published / প্রকাশিত</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $stats['published'] }}</h3>
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
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Draft / খসড়া</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $stats['draft'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-file-alt" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Featured / বৈশিষ্ট্য</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $stats['featured'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2);">
                            <i class="fas fa-star" style="color: #a855f7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row g-3 mb-4" style="background: rgba(15, 23, 42, 0.6); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
            <div class="col-md-6">
                <div class="position-relative">
                    <input type="text" id="searchInput" class="input-dark input-custom" placeholder="Search posts... / অনুসন্ধান..." style="color: white;" onkeyup="searchTable()">
                    <i class="fas fa-search input-icon"></i>
                </div>
            </div>
            <div class="col-md-3">
                <select class="input-dark input-custom" id="statusFilter" onchange="filterTable()">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="input-dark input-custom" id="categoryFilter" onchange="filterTable()">
                    <option value="">All Categories</option>
                    <option value="News">News</option>
                    <option value="Tutorial">Tutorial</option>
                    <option value="Recipe">Recipe</option>
                    <option value="Story">Story</option>
                    <option value="Announcement">Announcement</option>
                </select>
            </div>
        </div>

        <!-- Blog Posts Table -->
        <div class="table-responsive">
            <table class="table-custom" id="blogTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Title / শিরোনাম</th>
                        <th>Category / বিভাগ</th>
                        <th>Author / লেখক</th>
                        <th>Status / অবস্থা</th>
                        <th>Views / দর্শন</th>
                        <th>Date / তারিখ</th>
                        <th style="width: 180px;">Actions / কর্ম</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $index => $post)
                    <tr data-status="{{ $post->status }}" data-category="{{ $post->category ?? '' }}">
                        <td>{{ ($posts->currentPage() - 1) * $posts->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-start gap-3">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title_en }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 8px;">
                                        <i class="fas fa-newspaper" style="opacity: 0.5;"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-white fw-semibold" style="font-size: 0.95rem;">{{ Str::limit($post->title_en, 45) }}</div>
                                    <div style="font-size: 0.8rem; opacity: 0.6;">{{ Str::limit($post->title_bn, 45) }}</div>
                                    @if($post->is_featured)
                                        <span class="badge badge-visit-type mt-1" style="font-size: 0.7rem;">
                                            <i class="fas fa-star me-1"></i> Featured
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($post->category)
                                <span class="badge badge-completed">{{ $post->category }}</span>
                            @else
                                <span style="opacity: 0.5;">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-white" style="font-size: 0.85rem;">{{ $post->user->name }}</div>
                        </td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge badge-approved">Published</span>
                            @elseif($post->status === 'draft')
                                <span class="badge badge-pending">Draft</span>
                            @else
                                <span class="badge badge-cancelled">Archived</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-white fw-semibold">{{ $post->views }}</div>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem;">
                                <div class="text-white">{{ $post->created_at->format('M d, Y') }}</div>
                                <div style="opacity: 0.6; font-size: 0.75rem;">{{ $post->created_at->format('H:i') }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.blog.show', $post) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.blog.edit', $post) }}" class="action-btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="toggleStatus({{ $post->id }})" class="action-btn @if($post->status === 'published') 'btn-warning-action' @else 'btn-approve' @endif" title="Toggle Status">
                                    <i class="fas fa-power-off"></i>
                                </button>
                                <button onclick="deletePost({{ $post->id }}, '{{ Str::limit($post->title_en, 30) }}')" class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-newspaper" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No blog posts found / কোনো ব্লগ পোস্ট পাওয়া যায়নি</div>
                            <a href="{{ route('admin.ecommerce.blog.create') }}" class="btn-gradient" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                                <i class="fas fa-plus me-2"></i>Create Your First Post
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-white" style="opacity: 0.7;">
                Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} posts
            </div>
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>

@push('scripts')
<script>
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('blogTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const titleEn = row.getElementsByTagName('td')[1]?.textContent.toLowerCase() || '';
        const category = row.getElementsByTagName('td')[2]?.textContent.toLowerCase() || '';
        const author = row.getElementsByTagName('td')[3]?.textContent.toLowerCase() || '';

        if (titleEn.includes(filter) || category.includes(filter) || author.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

function filterTable() {
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
    const table = document.getElementById('blogTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const status = row.getAttribute('data-status')?.toLowerCase() || '';
        const category = row.getAttribute('data-category')?.toLowerCase() || '';

        const statusMatch = !statusFilter || status === statusFilter;
        const categoryMatch = !categoryFilter || category === categoryFilter;

        if (statusMatch && categoryMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

function toggleStatus(id) {
    if (!confirm('Are you sure you want to toggle the status of this post? / আপনি কি নিশ্চিত?')) {
        return;
    }

    fetch(`/admin/ecommerce/blog/${id}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonColor: '#22c55e'
            });
            setTimeout(() => location.reload(), 1500);
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong / কিছু ভুল হয়েছে',
            confirmButtonColor: '#ef4444'
        });
    });
}

function deletePost(id, title) {
    Swal.fire({
        title: 'Are you sure? / আপনি কি নিশ্চিত?',
        text: `You are about to delete "${title}". This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it! / হ্যাঁ, মুছে ফেলুন!',
        cancelButtonText: 'No, cancel! / না, বাতিল করুন!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/ecommerce/blog/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Blog post has been deleted. / ব্লগ পোস্ট মুছে ফেলা হয়েছে।',
                        confirmButtonColor: '#22c55e'
                    });
                    setTimeout(() => location.reload(), 1500);
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong / কিছু ভুল হয়েছে',
                    confirmButtonColor: '#ef4444'
                });
            });
        }
    });
}
</script>
@endpush

@include('admin.ecommerce.partials.common-styles')
@endsection
