@extends('layouts.admin')

@section('title', 'Tags - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Tags <span class="text-white">ট্যাগ</span></h2>
        <p class="text-white mb-0">Manage product tags for better organization</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.tags.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus me-2"></i> Add New Tag
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="glass-card mb-4">
    <div class="card-body bg-dark">
        <form action="{{ route('admin.ecommerce.tags.search') }}" method="GET" class="row g-3">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-white">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text"
                           name="q"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="Search tags... / ট্যাগ খুঁজুন..."
                           value="{{ $query ?? '' }}"
                           autofocus>
                    <button type="submit" class="btn btn-gradient">Search</button>
                    @isset($query)
                        <a href="{{ route('admin.ecommerce.tags.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear
                        </a>
                    @endisset
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tags Table -->
<div class="glass-card">
    <div class="card-body bg-dark p-0">
        <div class="table-responsive">
            <table class="table table-hover table-dark mb-0" style="background: transparent !important;">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white" style="border-color: #495057 !important;">ID</th>
                        <th class="text-white" style="border-color: #495057 !important;">Tag Name (EN) / ট্যাগের নাম (বাংলা)</th>
                        <th class="text-white" style="border-color: #495057 !important;">Products</th>
                        <th class="text-white" style="border-color: #495057 !important;">Created</th>
                        <th class="text-white" style="border-color: #495057 !important;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                        <tr style="border-color: #495057 !important;">
                            <td><code class="text-warning">#{{ $tag->id }}</code></td>
                            <td>
                                <div class="fw-bold text-white">{{ $tag->name_en }}</div>
                                <small class="text-info">{{ $tag->name_bn }}</small>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $tag->products_count }} product(s)</span>
                            </td>
                            <td>
                                <span class="text-white">{{ $tag->created_at->format('M d, Y') }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.ecommerce.tags.show', $tag) }}"
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.ecommerce.tags.edit', $tag) }}"
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteTag({{ $tag->id }}, '{{ $tag->name_en }}')"
                                            class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-tag fs-1 mb-3 d-block"></i>
                                    <p class="text-white">No tags found / কোন ট্যাগ পাওয়া যায়নি</p>
                                    <a href="{{ route('admin.ecommerce.tags.create') }}" class="btn btn-gradient mt-3">
                                        Create First Tag
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($tags->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $tags->appends(['q' => $query ?? null])->links() }}
    </div>
@endif

@endsection

@push('scripts')
<script>
function deleteTag(tagId, tagName) {
    event.preventDefault();

    Swal.fire({
        title: 'Delete Tag?',
        text: `Are you sure you want to delete "${tagName}"? আপনি কি নিশ্চিত যে আপনি এই ট্যাগটি মুছে ফেলতে চান?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ route('admin.ecommerce.tags.destroy', ':id') }}`.replace(':id', tagId), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.redirect) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Tag has been deleted.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '{{ route('admin.ecommerce.tags.index') }}';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to delete tag.',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong.',
                    icon: 'error'
                });
            });
        }
    });
}
</script>
@endpush
