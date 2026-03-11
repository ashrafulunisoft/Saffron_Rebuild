@extends('layouts.admin')

@section('title', 'Reviews - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Reviews <span class="text-white">রিভিউ</span></h2>
        <p class="text-white mb-0">Manage customer reviews and ratings</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-dark border-secondary mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary rounded p-3">
                            <i class="fas fa-star text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Total Reviews</h6>
                        <h3 class="fw-bold text-white mb-0">{{ $reviews->total() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark border-secondary mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning rounded p-3">
                            <i class="fas fa-clock text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Pending Approval</h6>
                        <h3 class="fw-bold text-white mb-0">{{ $pendingCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark border-secondary mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success rounded p-3">
                            <i class="fas fa-check-circle text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Approved</h6>
                        <h3 class="fw-bold text-white mb-0">{{ $approvedCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Search -->
<div class="glass-card mb-4">
    <div class="card-body bg-dark">
        <div class="row g-3">
            <div class="col-md-6">
                <form action="{{ route('admin.ecommerce.reviews.search') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group flex-grow-1">
                        <span class="input-group-text bg-dark border-secondary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                               name="q"
                               class="form-control bg-dark text-white border-secondary"
                               placeholder="Search reviews... / রিভিউ খুঁজুন..."
                               value="{{ $query ?? '' }}">
                        <button type="submit" class="btn btn-gradient">Search</button>
                    </div>
                    @isset($query)
                        <a href="{{ route('admin.ecommerce.reviews.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear
                        </a>
                    @endisset
                </form>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.ecommerce.reviews.index') }}"
                       class="btn flex-grow-1 @if(!request()->routeIs('admin.ecommerce.reviews.pending') && !request()->routeIs('admin.ecommerce.reviews.approved')) btn-gradient @else btn-outline-secondary @endif">
                        <i class="fas fa-list me-2"></i> All Reviews
                    </a>
                    <a href="{{ route('admin.ecommerce.reviews.pending') }}"
                       class="btn flex-grow-1 @if(request()->routeIs('admin.ecommerce.reviews.pending')) btn-warning @else btn-outline-secondary @endif">
                        <i class="fas fa-clock me-2"></i> Pending ({{ $pendingCount }})
                    </a>
                    <a href="{{ route('admin.ecommerce.reviews.approved') }}"
                       class="btn flex-grow-1 @if(request()->routeIs('admin.ecommerce.reviews.approved')) btn-success @else btn-outline-secondary @endif">
                        <i class="fas fa-check me-2"></i> Approved
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reviews Table -->
<div class="glass-card">
    <div class="card-body bg-dark p-0">
        <div class="table-responsive">
            <table class="table table-hover table-dark mb-0" style="background: transparent !important;">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white" style="border-color: #495057 !important;">ID</th>
                        <th class="text-white" style="border-color: #495057 !important;">Product</th>
                        <th class="text-white" style="border-color: #495057 !important;">Customer</th>
                        <th class="text-white" style="border-color: #495057 !important;">Rating</th>
                        <th class="text-white" style="border-color: #495057 !important;">Comment</th>
                        <th class="text-white" style="border-color: #495057 !important;">Status</th>
                        <th class="text-white" style="border-color: #495057 !important;">Date</th>
                        <th class="text-white" style="border-color: #495057 !important;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr style="border-color: #495057 !important;">
                            <td><code class="text-warning">#{{ $review->id }}</code></td>
                            <td>
                                <div class="fw-bold text-white">{{ $review->product->name_en ?? 'N/A' }}</div>
                                <small class="text-info">{{ $review->product->name_bn ?? '' }}</small>
                            </td>
                            <td>
                                <div class="fw-bold text-white">{{ $review->user->name ?? 'Guest' }}</div>
                                <small class="text-muted">{{ $review->user->email ?? 'N/A' }}</small>
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                                <span class="text-white ms-1">{{ $review->rating }}/5</span>
                            </td>
                            <td>
                                <div class="text-white" style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $review->comment ?? 'No comment' }}
                                </div>
                            </td>
                            <td>
                                @if($review->is_approved)
                                    <span class="badge bg-success">Approved / অনুমোদিত</span>
                                @else
                                    <span class="badge bg-warning">Pending / মুলতুব্বর</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-white">{{ $review->created_at->format('M d, Y') }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.ecommerce.reviews.show', $review) }}"
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(!$review->is_approved)
                                        <form action="{{ route('admin.ecommerce.reviews.approve', $review) }}"
                                              method="POST"
                                              style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-sm btn-success"
                                                    title="Approve"
                                                    onclick="return confirm('Approve this review? এই রিভিউ অনুমোদন করবেন?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.ecommerce.reviews.reject', $review) }}"
                                              method="POST"
                                              style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-sm btn-warning"
                                                    title="Reject"
                                                    onclick="return confirm('Reject this review? এই রিভিউ প্রত্যাখ্যান করবেন?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button onclick="deleteReview({{ $review->id }}, '{{ $review->user->name ?? 'Guest' }}')"
                                            class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-star fs-1 mb-3 d-block"></i>
                                    <p class="text-white">No reviews found / কোন রিভিউ পাওয়া যায়নি</p>
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
@if($reviews->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $reviews->appends(['q' => $query ?? null])->links() }}
    </div>
@endif

@endsection

@push('scripts')
<script>
function deleteReview(reviewId, customerName) {
    event.preventDefault();

    Swal.fire({
        title: 'Delete Review?',
        text: `Are you sure you want to delete the review from "${customerName}"? আপনি কি নিশ্চিত যে আপনি এই রিভিউ মুছে ফেলতে চান?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ route('admin.ecommerce.reviews.destroy', ':id') }}`.replace(':id', reviewId), {
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
                        text: 'Review has been deleted.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '{{ route('admin.ecommerce.reviews.index') }}';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to delete review.',
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
