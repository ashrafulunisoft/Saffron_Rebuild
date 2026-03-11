@extends('layouts.admin')

@section('title', 'Coupons - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Coupons <span class="text-white">কুপন</span></h2>
        <p class="text-white mb-0">Manage discount codes and promotions</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.coupons.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus me-2"></i> Add New Coupon
        </a>
    </div>
</div>

<!-- Search -->
<div class="glass-card mb-4">
    <div class="card-body bg-dark">
        <form action="{{ route('admin.ecommerce.coupons.search') }}" method="GET" class="row g-3">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-white">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text"
                           name="q"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="Search coupons... / কুপন খুঁজুন..."
                           value="{{ $query ?? '' }}"
                           autofocus>
                    <button type="submit" class="btn btn-gradient">Search</button>
                    @isset($query)
                        <a href="{{ route('admin.ecommerce.coupons.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear
                        </a>
                    @endisset
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Coupons Table -->
<div class="glass-card">
    <div class="card-body bg-dark p-0">
        <div class="table-responsive">
            <table class="table table-hover table-dark mb-0" style="background: transparent !important;">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white" style="border-color: #495057 !important;">ID</th>
                        <th class="text-white" style="border-color: #495057 !important;">Code</th>
                        <th class="text-white" style="border-color: #495057 !important;">Type</th>
                        <th class="text-white" style="border-color: #495057 !important;">Value</th>
                        <th class="text-white" style="border-color: #495057 !important;">Usage</th>
                        <th class="text-white" style="border-color: #495057 !important;">Expires</th>
                        <th class="text-white" style="border-color: #495057 !important;">Status</th>
                        <th class="text-white" style="border-color: #495057 !important;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr style="border-color: #495057 !important;">
                            <td><code class="text-warning">#{{ $coupon->id }}</code></td>
                            <td>
                                <div class="fw-bold text-white">{{ strtoupper($coupon->code) }}</div>
                            </td>
                            <td>
                                @if($coupon->type === 'percent')
                                    <span class="badge bg-info">Percentage %</span>
                                @else
                                    <span class="badge bg-success">Fixed Amount ৳</span>
                                @endif
                            </td>
                            <td>
                                @if($coupon->type === 'percent')
                                    <span class="text-white fs-5">{{ $coupon->value }}%</span>
                                    @if($coupon->max_discount)
                                        <br><small class="text-warning">Max: ৳{{ number_format($coupon->max_discount, 2) }}</small>
                                    @endif
                                @else
                                    <span class="text-white fs-5">৳{{ number_format($coupon->value, 2) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-white">{{ $coupon->usage_count }}</div>
                                @if($coupon->usage_limit)
                                    <small class="text-muted">/ {{ $coupon->usage_limit }}</small>
                                @else
                                    <small class="text-muted">/ Unlimited</small>
                                @endif
                            </td>
                            <td>
                                @if($coupon->expires_at)
                                    <span class="text-white">{{ $coupon->expires_at->format('M d, Y') }}</span>
                                    <br><small class="{{ $coupon->expires_at->isPast() ? 'text-danger' : 'text-success' }}">
                                        {{ $coupon->expires_at->isPast() ? 'Expired' : $coupon->expires_at->diffForHumans() }}
                                    </small>
                                @else
                                    <span class="text-muted">Never</span>
                                @endif
                            </td>
                            <td>
                                @if(!$coupon->expires_at || $coupon->expires_at->isFuture())
                                    @if($coupon->usage_limit && $coupon->usage_count >= $coupon->usage_limit)
                                        <span class="badge bg-danger">Exhausted</span>
                                    @else
                                        <span class="badge bg-success">Active / সক্রিয়</span>
                                    @endif
                                @else
                                    <span class="badge bg-danger">Expired / মেয়াদ উত্তীর্ণ</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.ecommerce.coupons.show', $coupon) }}"
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.ecommerce.coupons.edit', $coupon) }}"
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="toggleCouponStatus({{ $coupon->id }}, '{{ strtoupper($coupon->code) }}')"
                                            class="btn btn-sm @if(!$coupon->expires_at || $coupon->expires_at->isFuture()) btn-secondary @else btn-success @endif"
                                            title="{{ (!$coupon->expires_at || $coupon->expires_at->isFuture()) ? 'Expire' : 'Activate' }}">
                                        <i class="fas fa-{{ (!$coupon->expires_at || $coupon->expires_at->isFuture()) ? 'clock' : 'check' }}"></i>
                                    </button>
                                    <button onclick="deleteCoupon({{ $coupon->id }}, '{{ strtoupper($coupon->code) }}')"
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
                                    <i class="fas fa-ticket-alt fs-1 mb-3 d-block"></i>
                                    <p class="text-white">No coupons found / কোন কুপন পাওয়া যায়নি</p>
                                    <a href="{{ route('admin.ecommerce.coupons.create') }}" class="btn btn-gradient mt-3">
                                        Create First Coupon
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
@if($coupons->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $coupons->appends(['q' => $query ?? null])->links() }}
    </div>
@endif

@endsection

@push('scripts')
<script>
function toggleCouponStatus(couponId, couponCode) {
    event.preventDefault();

    Swal.fire({
        title: 'Toggle Coupon Status?',
        text: `Are you sure you want to toggle the status of "${couponCode}"? আপনি কি নিশ্চিত?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Yes, toggle it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ route('admin.ecommerce.coupons.toggle-status', ':id') }}`.replace(':id', couponId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Coupon status updated successfully.',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to update coupon status.',
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

function deleteCoupon(couponId, couponCode) {
    event.preventDefault();

    Swal.fire({
        title: 'Delete Coupon?',
        text: `Are you sure you want to delete "${couponCode}"? আপনি কি নিশ্চিত যে আপনি এই কুপনটি মুছে ফেলতে চান?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ route('admin.ecommerce.coupons.destroy', ':id') }}`.replace(':id', couponId), {
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
                        text: 'Coupon has been deleted.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '{{ route('admin.ecommerce.coupons.index') }}';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to delete coupon.',
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
