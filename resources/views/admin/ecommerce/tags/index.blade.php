@extends('layouts.admin')

@section('title', 'Tags - Saffron Admin')

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
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Tags</h2>
                <a href="{{ route('admin.ecommerce.tags.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-plus me-2"></i>Add Tag
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Tags</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalTags }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-tag" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Used</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $usedTags }}</h3>
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
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Unused</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $unusedTags }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-minus-circle" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Products</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalProducts }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2);">
                            <i class="fas fa-box" style="color: #a855f7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row g-3 mb-4" style="background: rgba(15, 23, 42, 0.6); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
            <div class="col-md-12">
                <form action="{{ route('admin.ecommerce.tags.search') }}" method="GET" class="d-flex gap-2">
                    <div class="position-relative flex-grow-1">
                        <input type="text"
                               name="q"
                               class="input-dark input-custom"
                               placeholder="Search tags..."
                               value="{{ $query ?? '' }}"
                               style="color: white;">
                    </div>
                    <button type="submit" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 12px;">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                    @isset($query)
                        <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn-outline" style="padding: 0.75rem 1rem; border-radius: 12px; text-decoration: none;">
                            <i class="fas fa-times me-2"></i>Clear
                        </a>
                    @endisset
                </form>
            </div>
        </div>

        <!-- Tags Table -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Tag Name</th>
                        <th>Products</th>
                        <th>Created</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $index => $tag)
                    <tr>
                        <td>{{ ($tags->currentPage() - 1) * $tags->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $tag->name_en }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.6;">{{ $tag->name_bn }}</div>
                        </td>
                        <td>
                            @if($tag->products_count > 0)
                                <span class="badge badge-completed">{{ $tag->products_count }} products</span>
                            @else
                                <span style="opacity: 0.5;">0</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 0.85rem;">{{ $tag->created_at->format('M d, Y') }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.tags.show', $tag) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.tags.edit', $tag) }}" class="action-btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteTag({{ $tag->id }}, '{{ $tag->name_en }}')" class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-tag" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No tags found</div>
                            <a href="{{ route('admin.ecommerce.tags.create') }}" class="btn-gradient" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                                <i class="fas fa-plus me-2"></i>Create First Tag
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tags->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                Showing {{ ($tags->currentPage() - 1) * $tags->perPage() + 1 }}
                to {{ min($tags->currentPage() * $tags->perPage(), $tags->total()) }}
                of {{ $tags->total() }} tags
            </div>
            {{ $tags->appends(['q' => $query ?? null])->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function deleteTag(tagId, tagName) {
    Swal.fire({
        title: 'Delete Tag?',
        text: `Are you sure you want to delete "${tagName}"? This action cannot be undone.`,
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
            window.location.href = `/admin/ecommerce/tags/${tagId}`;
        }
    });
}
</script>
@endpush

@push('styles')
@include('admin.ecommerce.partials.common-styles')
@endpush
@endsection
