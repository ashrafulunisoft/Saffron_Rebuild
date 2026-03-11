@extends('layouts.admin')

@section('title', 'Coupon Details - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">{{ strtoupper($coupon->code) }} <span class="text-white">কুপন</span></h2>
        <p class="text-white mb-0">Coupon details and usage information</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.coupons.edit', $coupon) }}" class="btn btn-gradient">
            <i class="fas fa-edit me-2"></i> Edit Coupon
        </a>
        <a href="{{ route('admin.ecommerce.coupons.index') }}" class="btn btn-outline ms-2">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</div>

<!-- Coupon Details -->
<div class="glass-card mb-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-primary border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-ticket-alt me-2"></i>Coupon Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Coupon ID:</label></div>
                        <div class="col-sm-8"><code class="text-warning">#{{ $coupon->id }}</code></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Coupon Code:</label></div>
                        <div class="col-sm-8">
                            <div class="fw-bold text-white fs-5">{{ strtoupper($coupon->code) }}</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Discount Type:</label></div>
                        <div class="col-sm-8">
                            @if($coupon->type === 'percent')
                                <span class="badge bg-info fs-6">Percentage / শতাংশ</span>
                            @else
                                <span class="badge bg-success fs-6">Fixed Amount / নির্দিষ্ট পরিমাণ</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Discount Value:</label></div>
                        <div class="col-sm-8">
                            @if($coupon->type === 'percent')
                                <span class="text-white fs-4 fw-bold">{{ $coupon->value }}%</span>
                                @if($coupon->max_discount)
                                    <br><small class="text-warning">Maximum: ৳{{ number_format($coupon->max_discount, 2) }}</small>
                                @endif
                            @else
                                <span class="text-white fs-4 fw-bold">৳{{ number_format($coupon->value, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><label class="text-muted">Expiration Date:</label></div>
                        <div class="col-sm-8">
                            @if($coupon->expires_at)
                                <span class="text-white">{{ $coupon->expires_at->format('M d, Y h:i A') }}</span>
                                <br>
                                <small class="{{ $coupon->expires_at->isPast() ? 'text-danger' : 'text-success' }}">
                                    {{ $coupon->expires_at->isPast() ? 'Expired' : 'Expires in ' . $coupon->expires_at->diffForHumans() }}
                                </small>
                            @else
                                <span class="text-muted">No expiration / মেয়াদ নেই</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><label class="text-muted">Created:</label></div>
                        <div class="col-sm-8"><span class="text-white">{{ $coupon->created_at->format('M d, Y h:i A') }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-header bg-success border-secondary">
                    <h5 class="mb-0 text-white"><i class="fas fa-chart-bar me-2"></i>Usage Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card bg-primary border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-shopping-cart text-white fs-1 mb-2"></i>
                                    <h3 class="fw-bold text-white mb-0">{{ $coupon->usage_count }}</h3>
                                    <small class="text-white-50">Times Used</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-info border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-receipt text-white fs-1 mb-2"></i>
                                    <h3 class="fw-bold text-white mb-0">{{ $coupon->orders()->count() }}</h3>
                                    <small class="text-white-50">Orders</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($coupon->usage_limit)
                        <div class="mt-3 text-center">
                            <small class="text-muted">Usage Limit: {{ $coupon->usage_count }} / {{ $coupon->usage_limit }}</small>
                            <div class="progress mt-2" style="height: 10px;">
                                <?php $percentage = min(($coupon->usage_count / $coupon->usage_limit) * 100, 100); ?>
                                <div class="progress-bar @if($percentage >= 100) bg-danger @elseif($percentage >= 75) bg-warning @else bg-success @endif"
                                     role="progressbar"
                                     style="width: {{ $percentage }}%">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Orders with this coupon -->
<div class="glass-card">
    <div class="card-header bg-info border-secondary">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white"><i class="fas fa-shopping-bag me-2"></i>Orders with "{{ strtoupper($coupon->code) }}" Coupon ({{ $coupon->orders()->count() }})</h5>
            @if($coupon->orders()->count() > 10)
                <a href="{{ route('admin.ecommerce.orders.index') }}" class="btn btn-sm btn-light">View All Orders</a>
            @endif
        </div>
    </div>
    <div class="card-body bg-dark">
        @if($coupon->orders()->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th class="text-white">Order ID</th>
                            <th class="text-white">Customer</th>
                            <th class="text-white">Total</th>
                            <th class="text-white">Discount</th>
                            <th class="text-white">Final Amount</th>
                            <th class="text-white">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupon->orders()->latest()->take(10) as $order)
                            <tr>
                                <td><code class="text-warning">#{{ $order->order_number }}</code></td>
                                <td>
                                    <div class="fw-bold text-white">{{ $order->user->name ?? 'Guest' }}</div>
                                    <small class="text-info">{{ $order->user->email ?? 'N/A' }}</small>
                                </td>
                                <td><span class="text-white">৳{{ number_format($order->total_amount, 2) }}</span></td>
                                <td><span class="text-success">-৳{{ number_format($order->discount, 2) }}</span></td>
                                <td><span class="text-white fw-bold">৳{{ number_format($order->final_amount, 2) }}</span></td>
                                <td><span class="text-white">{{ $order->created_at->format('M d, Y') }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-shopping-cart text-muted fs-1 mb-3 d-block"></i>
                <p class="text-white">This coupon hasn't been used yet.</p>
                <small class="text-muted">Orders using this coupon will appear here.</small>
            </div>
        @endif
    </div>
</div>

@endsection
