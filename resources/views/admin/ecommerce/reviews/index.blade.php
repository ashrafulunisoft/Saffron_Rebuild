@extends('layouts.admin')

@section('title', 'Reviews - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">REVIEW MANAGEMENT</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Reviews</h2>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Reviews</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalReviews ?? $reviews->total() }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-star" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Pending</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $pendingReviews }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-clock" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Approved</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $approvedReviews }}</h3>
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
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Avg Rating</h6>
                            <h3 class="text-white fw-800 mb-0">{{ number_format($averageRating, 1) }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2);">
                            <i class="fas fa-award" style="color: #a855f7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <form action="{{ route('admin.ecommerce.reviews.search') }}" method="GET">
                    <div class="position-relative">
                        <input type="text"
                               name="q"
                               class="input-dark input-custom"
                               placeholder="Search reviews... / রিভিউ খুঁজুন..."
                               value="{{ $query ?? '' }}">

                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.ecommerce.reviews.index') }}"
                       class="btn flex-grow-1 @if(request()->routeIs('admin.ecommerce.reviews.index')) btn-gradient @else btn-outline @endif"
                       style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                        <i class="fas fa-list me-2"></i> All
                    </a>
                    <a href="{{ route('admin.ecommerce.reviews.pending') }}"
                       class="btn flex-grow-1 @if(request()->routeIs('admin.ecommerce.reviews.pending')) btn-gradient @else btn-outline @endif"
                       style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                        <i class="fas fa-clock me-2"></i> Pending
                    </a>
                    <a href="{{ route('admin.ecommerce.reviews.approved') }}"
                       class="btn flex-grow-1 @if(request()->routeIs('admin.ecommerce.reviews.approved')) btn-gradient @else btn-outline @endif"
                       style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                        <i class="fas fa-check me-2"></i> Approved
                    </a>
                </div>
            </div>
        </div>

        <!-- Reviews Table -->
        <div class="table-responsive mb-4" style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $index => $review)
                        <tr>
                            <td>{{ ($reviews->currentPage() - 1) * $reviews->perPage() + $index + 1 }}</td>
                            <td>
                                <div class="fw-700 text-white">{{ $review->product->name_en ?? 'N/A' }}</div>
                                <div style="font-size: 0.75rem; opacity: 0.6;">{{ $review->product->name_bn ?? '' }}</div>
                            </td>
                            <td>
                                <div class="fw-700 text-white">{{ $review->user->name ?? 'Guest' }}</div>
                                <div style="font-size: 0.75rem; opacity: 0.6;">{{ $review->user->email ?? 'N/A' }}</div>
                            </td>
                            <td>
                                <span style="color: #fbbf24; margin-right: 0.25rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star" style="font-size: 0.85rem;"></i>
                                        @else
                                            <i class="far fa-star" style="font-size: 0.85rem; opacity: 0.4;"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-white fw-700">{{ $review->rating }}</span>
                            </td>
                            <td>
                                <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 0.85rem;">
                                    {{ $review->comment ?? 'No comment' }}
                                </div>
                            </td>
                            <td>
                                @if($review->is_approved)
                                    <span class="badge badge-approved">Approved</span>
                                @else
                                    <span class="badge badge-pending">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div style="font-size: 0.85rem;">{{ $review->created_at->format('M d, Y') }}</div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.ecommerce.reviews.show', $review) }}" class="action-btn btn-view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(!$review->is_approved)
                                        <form action="{{ route('admin.ecommerce.reviews.approve', $review) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn btn-approve" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.ecommerce.reviews.reject', $review) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn btn-edit" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button onclick="deleteReview({{ $review->id }}, '{{ $review->user->name ?? 'Guest' }}')" class="action-btn btn-delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-star" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                                <div class="text-white" style="opacity: 0.5;">No reviews found</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Info -->
        @if($reviews->hasPages())
            <div class="d-flex justify-content-between align-items-center" style="background: rgba(15, 23, 42, 0.4); border-radius: 12px; padding: 1rem 1.5rem;">
                <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                    Showing <strong>{{ ($reviews->currentPage() - 1) * $reviews->perPage() + 1 }}</strong> to
                    <strong>{{ min($reviews->currentPage() * $reviews->perPage(), $reviews->total()) }}</strong> of
                    <strong>{{ $reviews->total() }}</strong> reviews
                </div>
                <div>
                    {{ $reviews->appends(['q' => $query ?? null])->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    .input-dark {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        transition: 0.3s;
        width: 100%;
    }

    .input-dark:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    .input-dark::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .input-custom {
        font-size: 0.9rem;
    }

    

    .btn-gradient {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        color: #fff;
        border: none;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: 0.3s;
    }

    .btn-outline:hover {
        border-color: var(--accent-blue);
        background: rgba(59, 130, 246, 0.1);
    }

    .glass-card-dark {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(59, 130, 246, 0.1);
    }

    .logo-vms {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .permission-title {
        color: var(--accent-blue);
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.3);
    }

    .text-shadow-white {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .text-shadow-blue {
        text-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }
</style>
@endpush

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
@endsection
