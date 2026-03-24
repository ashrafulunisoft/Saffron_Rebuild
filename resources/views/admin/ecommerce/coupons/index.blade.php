@extends('layouts.admin')

@section('title', 'Coupons - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">COUPON MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Coupons</h2>
                <a href="{{ route('admin.ecommerce.coupons.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-plus me-2"></i>Add Coupon
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Coupons</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalCoupons }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-ticket-alt" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Active</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $activeCoupons }}</h3>
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
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Expired</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $expiredCoupons }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.2);">
                            <i class="fas fa-clock" style="color: #ef4444;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Exhausted</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $exhaustedCoupons }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-ban" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row g-3 mb-4" style="background: rgba(15, 23, 42, 0.6); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
            <div class="col-md-12">
                <form action="{{ route('admin.ecommerce.coupons.search') }}" method="GET" class="d-flex gap-2">
                    <div class="position-relative flex-grow-1">
                        <input type="text"
                               name="q"
                               class="input-dark input-custom"
                               placeholder="Search coupons..."
                               value="{{ $query ?? '' }}"
                               style="color: white;">
                    </div>
                    <button type="submit" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 12px;">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                    @isset($query)
                        <a href="{{ route('admin.ecommerce.coupons.index') }}" class="btn-outline" style="padding: 0.75rem 1rem; border-radius: 12px; text-decoration: none;">
                            <i class="fas fa-times me-2"></i>Clear
                        </a>
                    @endisset
                </form>
            </div>
        </div>

        <!-- Coupons Table -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Usage</th>
                        <th>Expires</th>
                        <th>Status</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $index => $coupon)
                    <tr>
                        <td>{{ ($coupons->currentPage() - 1) * $coupons->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="text-white fw-700" style="font-size: 1rem; letter-spacing: 1px;">{{ strtoupper($coupon->code) }}</div>
                        </td>
                        <td>
                            @if($coupon->type === 'percent')
                                <span class="badge badge-completed">Percentage %</span>
                            @else
                                <span class="badge badge-approved">Fixed ৳</span>
                            @endif
                        </td>
                        <td>
                            @if($coupon->type === 'percent')
                                <div class="text-white fw-700" style="font-size: 1.1rem;">{{ $coupon->value }}%</div>
                                @if($coupon->max_discount)
                                    <div style="font-size: 0.7rem; color: #fbbf24;">Max: ৳{{ number_format($coupon->max_discount, 2) }}</div>
                                @endif
                            @else
                                <div class="text-white fw-700" style="font-size: 1.1rem;">৳{{ number_format($coupon->value, 2) }}</div>
                            @endif
                        </td>
                        <td>
                            <div class="text-white" style="font-size: 0.9rem;">{{ $coupon->usage_count }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.6;">
                                @if($coupon->usage_limit)
                                    / {{ $coupon->usage_limit }}
                                @else
                                    / Unlimited
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($coupon->expires_at)
                                <div style="font-size: 0.85rem;">{{ $coupon->expires_at->format('M d, Y') }}</div>
                                <div style="font-size: 0.7rem; {{ $coupon->expires_at->isPast() ? 'color: #ef4444;' : 'color: #22c55e;' }}">
                                    {{ $coupon->expires_at->isPast() ? 'Expired' : $coupon->expires_at->diffForHumans() }}
                                </div>
                            @else
                                <span style="opacity: 0.5;">Never</span>
                            @endif
                        </td>
                        <td>
                            @if(!$coupon->expires_at || $coupon->expires_at->isFuture())
                                @if($coupon->usage_limit && $coupon->usage_count >= $coupon->usage_limit)
                                    <span class="badge badge-cancelled">Exhausted</span>
                                @else
                                    <span class="badge badge-approved">Active</span>
                                @endif
                            @else
                                <span class="badge badge-cancelled">Expired</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.coupons.show', $coupon) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.ecommerce.coupons.edit', $coupon) }}" class="action-btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="toggleCouponStatus({{ $coupon->id }}, '{{ strtoupper($coupon->code) }}')"
                                        class="action-btn @if(!$coupon->expires_at || $coupon->expires_at->isFuture()) 'btn-warning-action' @else 'btn-approve' @endif"
                                        title="@if(!$coupon->expires_at || $coupon->expires_at->isFuture()) Expire @else Activate @endif">
                                    <i class="fas fa-@if(!$coupon->expires_at || $coupon->expires_at->isFuture()) clock @else check @endif"></i>
                                </button>
                                <button onclick="deleteCoupon({{ $coupon->id }}, '{{ strtoupper($coupon->code) }}')" class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-ticket-alt" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No coupons found</div>
                            <a href="{{ route('admin.ecommerce.coupons.create') }}" class="btn-gradient" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                                <i class="fas fa-plus me-2"></i>Create First Coupon
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($coupons->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                Showing {{ ($coupons->currentPage() - 1) * $coupons->perPage() + 1 }}
                to {{ min($coupons->currentPage() * $coupons->perPage(), $coupons->total()) }}
                of {{ $coupons->total() }} coupons
            </div>
            {{ $coupons->appends(['q' => $query ?? null])->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function toggleCouponStatus(couponId, couponCode) {
    Swal.fire({
        title: 'Toggle Status?',
        text: `Toggle status for "${couponCode}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#fbbf24',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, toggle it!',
        cancelButtonText: 'Cancel',
        background: '#0f172a',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/admin/ecommerce/coupons/${couponId}/toggle-status`;
        }
    });
}

function deleteCoupon(couponId, couponCode) {
    Swal.fire({
        title: 'Delete Coupon?',
        text: `Are you sure you want to delete "${couponCode}"? This action cannot be undone.`,
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
            window.location.href = `/admin/ecommerce/coupons/${couponId}`;
        }
    });
}
</script>
@endpush

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    .btn-warning-action {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }

    .btn-warning-action:hover {
        background: #fbbf24;
        color: #000;
    }
</style>
@endpush
@endsection
