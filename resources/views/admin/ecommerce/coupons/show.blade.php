@extends('layouts.admin')

@section('title', "Coupon - {$coupon->code}")

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
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">{{ strtoupper($coupon->code) }}</h2>
                <a href="{{ route('admin.ecommerce.coupons.edit', $coupon) }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.ecommerce.coupons.index') }}" class="btn-outline" style="padding: 0.75rem 1rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>

        <!-- Coupon Summary -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Coupon Type</h6>
                        <div>
                            @if($coupon->type === 'percent')
                                <span class="badge badge-completed" style="font-size: 0.9rem;">Percentage %</span>
                            @else
                                <span class="badge badge-approved" style="font-size: 0.9rem;">Fixed ৳</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Discount Value</h6>
                        <div class="text-white fw-800" style="font-size: 1.5rem;">
                            @if($coupon->type === 'percent')
                                {{ $coupon->value }}%
                            @else
                                ৳{{ number_format($coupon->value, 2) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Times Used</h6>
                        <h3 class="text-white fw-800 mb-0">{{ $coupon->usage_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Orders</h6>
                        <h3 class="text-white fw-800 mb-0">{{ $coupon->orders()->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coupon Details -->
        <div class="row g-4 mb-5">
            <!-- Coupon Information -->
            <div class="col-md-8">
                <div class="permission-title">Coupon Information</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">COUPON CODE</label>
                            <div class="text-white fw-700" style="font-size: 1.1rem; letter-spacing: 1px;">{{ strtoupper($coupon->code) }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">COUPON ID</label>
                            <div><code style="color: #fbbf24; font-size: 0.9rem;">#{{ $coupon->id }}</code></div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">DISCOUNT TYPE</label>
                            <div>
                                @if($coupon->type === 'percent')
                                    <span class="badge badge-completed">Percentage / শতাংশ</span>
                                @else
                                    <span class="badge badge-approved">Fixed Amount / নির্দিষ্ট পরিমাণ</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">DISCOUNT VALUE</label>
                            <div class="text-white fw-700" style="font-size: 1.1rem;">
                                @if($coupon->type === 'percent')
                                    {{ $coupon->value }}%
                                    @if($coupon->max_discount)
                                        <div style="font-size: 0.75rem; color: #fbbf24;">Max: ৳{{ number_format($coupon->max_discount, 2) }}</div>
                                    @endif
                                @else
                                    ৳{{ number_format($coupon->value, 2) }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">EXPIRATION DATE</label>
                            <div>
                                @if($coupon->expires_at)
                                    <div style="font-size: 0.9rem;">{{ $coupon->expires_at->format('M d, Y h:i A') }}</div>
                                    <div style="font-size: 0.75rem; {{ $coupon->expires_at->isPast() ? 'color: #ef4444;' : 'color: #22c55e;' }}">
                                        {{ $coupon->expires_at->isPast() ? 'Expired' : 'Expires in ' . $coupon->expires_at->diffForHumans() }}
                                    </div>
                                @else
                                    <span style="opacity: 0.5;">No expiration</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">CREATED</label>
                            <div style="font-size: 0.9rem;">{{ $coupon->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage Statistics -->
            <div class="col-md-4">
                <div class="permission-title">Usage Statistics</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div style="background: rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem; text-align: center;">
                                <i class="fas fa-shopping-cart" style="color: var(--accent-blue); font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                <div class="text-white fw-800" style="font-size: 1.5rem;">{{ $coupon->usage_count }}</div>
                                <div style="font-size: 0.7rem; opacity: 0.6;">Used</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background: rgba(34, 197, 94, 0.2); border-radius: 12px; padding: 1rem; text-align: center;">
                                <i class="fas fa-receipt" style="color: #22c55e; font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                <div class="text-white fw-800" style="font-size: 1.5rem;">{{ $coupon->orders()->count() }}</div>
                                <div style="font-size: 0.7rem; opacity: 0.6;">Orders</div>
                            </div>
                        </div>
                    </div>

                    @if($coupon->usage_limit)
                        <div>
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.85rem;">
                                <span class="text-muted">Usage Limit</span>
                                <span class="text-white">{{ $coupon->usage_count }} / {{ $coupon->usage_limit }}</span>
                            </div>
                            <div style="background: rgba(255, 255, 255, 0.1); border-radius: 8px; height: 8px; overflow: hidden;">
                                @php $percentage = min(($coupon->usage_count / $coupon->usage_limit) * 100, 100); @endphp
                                <div style="background: @if($percentage >= 100) #ef4444 @elseif($percentage >= 75) #fbbf24 @else #22c55e @endif; height: 100%; width: {{ $percentage }}%; transition: width 0.3s;"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Orders with this coupon -->
        <div class="permission-title">Orders with "{{ strtoupper($coupon->code) }}" Coupon ({{ $coupon->orders()->count() }})</div>
        @if($coupon->orders()->count() > 0)
            <div style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
                <table class="table-custom" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Final Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupon->orders()->latest()->take(10) as $order)
                        <tr>
                            <td>
                                <code style="font-size: 0.85rem;">{{ $order->order_number }}</code>
                            </td>
                            <td>
                                @if($order->user)
                                    <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $order->user->name }}</div>
                                    <div style="font-size: 0.75rem; opacity: 0.6;">{{ $order->user->email }}</div>
                                @else
                                    <span style="opacity: 0.5;">Guest</span>
                                @endif
                            </td>
                            <td>
                                <div style="font-size: 0.9rem;">৳{{ number_format($order->total_amount, 2) }}</div>
                            </td>
                            <td>
                                <div style="color: #22c55e; font-size: 0.9rem;">-৳{{ number_format($order->discount, 2) }}</div>
                            </td>
                            <td>
                                <div class="text-white fw-700" style="font-size: 0.95rem;">৳{{ number_format($order->final_amount, 2) }}</div>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem;">{{ $order->created_at->format('M d, Y') }}</div>
                            </td>
                            <td>
                                <a href="{{ route('admin.ecommerce.orders.show', $order) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($coupon->orders()->count() > 10)
                <div class="text-center mt-4">
                    <a href="{{ route('admin.ecommerce.orders.index') }}" class="btn-outline" style="padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                        View All Orders
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-5" style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
                <i class="fas fa-shopping-cart" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                <div class="text-white" style="opacity: 0.5;">This coupon hasn't been used yet</div>
                <div style="font-size: 0.85rem; opacity: 0.5; margin-top: 0.5rem;">Orders using this coupon will appear here</div>
            </div>
        @endif
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')
@endpush
@endsection
