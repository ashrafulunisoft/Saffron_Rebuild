@extends('layouts.admin')

@section('title', 'Review Details - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Review #{{ $review->id }} <span class="text-white">রিভিউ</span></h2>
        <p class="text-white mb-0">Review details and information</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.reviews.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left me-2"></i> Back to Reviews
        </a>
    </div>
</div>

<!-- Review Details -->
<div class="glass-card mb-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-primary border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-star me-2"></i>Review Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Review ID:</label></div>
                        <div class="col-sm-8"><code class="text-warning">#{{ $review->id }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Customer:</label></div>
                        <div class="col-sm-8">
                            <div class="fw-bold text-white">{{ $review->user->name ?? 'Guest' }}</div>
                            <small class="text-info">{{ $review->user->email ?? 'N/A' }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Product:</label></div>
                        <div class="col-sm-8">
                            <div class="fw-bold text-white">{{ $review->product->name_en ?? 'N/A' }}</div>
                            <small class="text-info">{{ $review->product->name_bn ?? '' }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Rating:</label></div>
                        <div class="col-sm-8">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <i class="fas fa-star text-warning fs-5"></i>
                                @else
                                    <i class="far fa-star text-muted fs-5"></i>
                                @endif
                            @endfor
                            <span class="text-white fs-5 fw-bold ms-2">{{ $review->rating }}/5</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Status:</label></div>
                        <div class="col-sm-8">
                            @if($review->is_approved)
                                <span class="badge bg-success fs-6">Approved / অনুমোদিত</span>
                            @else
                                <span class="badge bg-warning fs-6">Pending / মুলতুব্বর</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Review Date:</label></div>
                        <div class="col-sm-8"><span class="text-white">{{ $review->created_at->format('M d, Y h:i A') }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-info border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-cog me-2"></i>Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if(!$review->is_approved)
                            <form action="{{ route('admin.ecommerce.reviews.approve', $review) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="btn btn-success"
                                        onclick="return confirm('Approve this review? এই রিভিউ অনুমোদন করবেন?')">
                                    <i class="fas fa-check me-2"></i> Approve Review
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.ecommerce.reviews.reject', $review) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="btn btn-warning"
                                        onclick="return confirm('Reject this review? এই রিভিউ প্রত্যাখ্যান করবেন?')">
                                    <i class="fas fa-times me-2"></i> Reject Review
                                </button>
                            </form>
                        @endif
                        <button onclick="deleteReview({{ $review->id }}, '{{ $review->user->name ?? 'Guest' }}')"
                                class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i> Delete Review
                        </button>
                        <a href="{{ route('admin.ecommerce.products.show', $review->product) }}"
                           class="btn btn-outline-secondary">
                            <i class="fas fa-box me-2"></i> View Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Comment -->
@if($review->comment)
    <div class="glass-card">
        <div class="card-header bg-warning border-secondary">
            <h5 class="mb-0 text-white"><i class="fas fa-comment me-2"></i>Customer Comment</h5>
        </div>
        <div class="card-body bg-dark">
            <div class="text-white" style="white-space: pre-wrap; line-height: 1.6;">
                {{ $review->comment }}
            </div>
        </div>
    </div>
@else
    <div class="glass-card">
        <div class="card-body bg-dark">
            <div class="text-center py-4">
                <i class="fas fa-comment-slash text-muted fs-1 mb-3 d-block"></i>
                <p class="text-white">No comment provided by customer.</p>
            </div>
        </div>
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
