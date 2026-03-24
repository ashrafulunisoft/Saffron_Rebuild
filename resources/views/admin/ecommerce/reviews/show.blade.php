@extends('layouts.admin')

@section('title', "Review #{$review->id} - Saffron Admin")

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
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Review Details</h2>
                <a href="{{ route('admin.ecommerce.reviews.index') }}" class="btn-outline" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Review Info & Rating -->
            <div class="col-md-8">
                <div class="permission-title">Review Information</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 2rem;">
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem;">
                                <label class="text-muted" style="font-size: 0.75rem;">REVIEW ID</label>
                                <div><code style="color: #fbbf24; font-size: 0.9rem;">#{{ $review->id }}</code></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem;">
                                <label class="text-muted" style="font-size: 0.75rem;">STATUS</label>
                                <div>
                                    @if($review->is_approved)
                                        <span class="badge badge-approved">Approved</span>
                                    @else
                                        <span class="badge badge-pending">Pending</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem;">
                                <label class="text-muted" style="font-size: 0.75rem;">DATE</label>
                                <div class="text-white" style="font-size: 0.9rem;">{{ $review->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Customer</label>
                        <div style="background: rgba(15, 23, 42, 0.4); border-radius: 12px; padding: 1rem 1.25rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle" style="width: 48px; height: 48px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6); flex-shrink: 0;">
                                    {{ strtoupper(substr($review->user->name ?? 'G', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-800 text-white">{{ $review->user->name ?? 'Guest' }}</div>
                                    <div style="font-size: 0.8rem; opacity: 0.6;">{{ $review->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Product</label>
                        <div style="background: rgba(15, 23, 42, 0.4); border-radius: 12px; padding: 1rem 1.25rem;">
                            <div class="fw-800 text-white">{{ $review->product->name_en ?? 'N/A' }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.6;">{{ $review->product->name_bn ?? '' }}</div>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Rating</label>
                        <div style="background: rgba(15, 23, 42, 0.4); border-radius: 12px; padding: 1rem 1.5rem;">
                            <span style="color: #fbbf24; font-size: 1.5rem; margin-right: 0.5rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star" style="opacity: 0.4;"></i>
                                    @endif
                                @endfor
                            </span>
                            <span class="text-white fw-800" style="font-size: 1.5rem;">{{ $review->rating }}/5</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="col-md-4">
                <div class="permission-title">Review Actions</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 2rem;">
                    <div class="d-grid gap-3">
                        @if(!$review->is_approved)
                            <form action="{{ route('admin.ecommerce.reviews.approve', $review) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="btn-gradient"
                                        style="width: 100%; padding: 1rem 2rem; border-radius: 100px; background: linear-gradient(135deg, #22c55e, #10b981);"
                                        onclick="return confirm('Approve this review? এই রিভিউ অনুমোদন করবেন?')">
                                    <i class="fas fa-check me-2"></i>Approve Review
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.ecommerce.reviews.reject', $review) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="btn-gradient"
                                        style="width: 100%; padding: 1rem 2rem; border-radius: 100px; background: linear-gradient(135deg, #fbbf24, #f59e0b);"
                                        onclick="return confirm('Reject this review? এই রিভিউ প্রত্যাখ্যান করবেন?')">
                                    <i class="fas fa-times me-2"></i>Reject Review
                                </button>
                            </form>
                        @endif

                        <button onclick="deleteReview({{ $review->id }}, '{{ $review->user->name ?? 'Guest' }}')"
                                class="btn-outline"
                                style="width: 100%; padding: 1rem 2rem; border-radius: 100px; border-color: #ef4444; color: #ef4444;">
                            <i class="fas fa-trash me-2"></i>Delete Review
                        </button>

                        <a href="{{ route('admin.ecommerce.products.show', $review->product) }}"
                           class="btn-outline"
                           style="width: 100%; padding: 1rem 2rem; border-radius: 100px; text-align: center; display: block; text-decoration: none;">
                            <i class="fas fa-box me-2"></i>View Product
                        </a>
                    </div>

                    @if($review->is_approved)
                        <div class="mt-4 p-3 rounded" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3);">
                            <i class="fas fa-check-circle" style="color: #22c55e; margin-right: 0.5rem;"></i>
                            <span style="font-size: 0.85rem; opacity: 0.8;">
                                This review is approved and visible to customers.
                            </span>
                        </div>
                    @else
                        <div class="mt-4 p-3 rounded" style="background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.3);">
                            <i class="fas fa-clock" style="color: #fbbf24; margin-right: 0.5rem;"></i>
                            <span style="font-size: 0.85rem; opacity: 0.8;">
                                This review is pending approval and not yet visible.
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer Comment -->
        @if($review->comment)
            <div class="permission-title">Customer Comment</div>
            <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 2rem;">
                <div class="text-white" style="white-space: pre-wrap; line-height: 1.8; font-size: 0.95rem;">
                    {{ $review->comment }}
                </div>
            </div>
        @else
            <div class="permission-title">Customer Comment</div>
            <div class="text-center py-5" style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
                <i class="fas fa-comment-slash" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                <div class="text-white" style="opacity: 0.5;">No comment provided by customer</div>
            </div>
        @endif
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    .form-label {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

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

    

    .text-muted {
        color: rgba(255, 255, 255, 0.5) !important;
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

    .avatar-circle {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
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
