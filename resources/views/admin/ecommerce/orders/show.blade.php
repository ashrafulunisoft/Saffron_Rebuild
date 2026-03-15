@extends('layouts.admin')

@section('title', "Order #{$order->order_number} - Saffron Admin")

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">ORDER MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Order Details</h2>
                <a href="{{ route('admin.ecommerce.orders.index') }}" class="btn-outline" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Order Number</h6>
                        <code style="color: #fbbf24; font-size: 0.9rem;">{{ $order->order_number }}</code>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Order Date</h6>
                        <div class="text-white" style="font-size: 0.9rem;">{{ $order->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Amount</h6>
                        <div class="text-white fw-800" style="font-size: 1.2rem;">৳{{ number_format($order->final_amount, 2) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div>
                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Items</h6>
                        <div class="text-white fw-800" style="font-size: 1.2rem;">{{ $order->orderItems->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details & Status -->
        <div class="row g-4 mb-5">
            <!-- Order Information -->
            <div class="col-md-8">
                <div class="permission-title">Order Information</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">CUSTOMER NAME</label>
                            <div class="text-white fw-600" style="font-size: 0.95rem;">{{ $order->user->name ?? 'Guest' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">CUSTOMER EMAIL</label>
                            <div style="font-size: 0.9rem; opacity: 0.8;">{{ $order->user->email ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">ORDER STATUS</label>
                            <div>
                                @if($order->status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($order->status === 'processing')
                                    <span class="badge badge-visit-type">Processing</span>
                                @elseif($order->status === 'shipped')
                                    <span class="badge badge-completed">Shipped</span>
                                @elseif($order->status === 'delivered')
                                    <span class="badge badge-approved">Delivered</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-cancelled">Cancelled</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted" style="font-size: 0.75rem;">PAYMENT STATUS</label>
                            <div>
                                @if($order->payment_status === 'paid')
                                    <span class="badge badge-approved">Paid</span>
                                @elseif($order->payment_status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($order->payment_status === 'failed')
                                    <span class="badge badge-cancelled">Failed</span>
                                @else
                                    <span class="badge badge-completed">Refunded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Totals -->
            <div class="col-md-4">
                <div class="permission-title">Order Totals</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted" style="font-size: 0.85rem;">Subtotal</span>
                        <span class="text-white" style="font-size: 0.9rem;">৳{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    @if($order->coupon)
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted" style="font-size: 0.85rem;">Coupon</span>
                            <span class="badge badge-visit-type">{{ strtoupper($order->coupon->code) }}</span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted" style="font-size: 0.85rem;">Discount</span>
                        <span style="color: #ef4444; font-size: 0.9rem;">-৳{{ number_format($order->discount, 2) }}</span>
                    </div>
                    <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem; margin-top: 0.5rem;">
                        <div class="d-flex justify-content-between">
                            <span class="text-white fw-600" style="font-size: 0.95rem;">Total</span>
                            <span class="text-success fw-800" style="font-size: 1.2rem;">৳{{ number_format($order->final_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="permission-title">Order Items</div>
        <div style="background: rgba(15, 23, 42, 0.4); border-radius: 16px; padding: 0;">
            <table class="table-custom" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>
                            <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $item->product->name_en }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.6;">{{ $item->product->name_bn }}</div>
                            @if($item->product->category)
                                <div style="font-size: 0.7rem; opacity: 0.5; margin-top: 0.25rem;">{{ $item->product->category->name_en }}</div>
                            @endif
                        </td>
                        <td>
                            <code style="font-size: 0.85rem;">{{ $item->product->sku }}</code>
                        </td>
                        <td>
                            <div style="font-size: 0.9rem;">৳{{ number_format($item->price, 2) }}</div>
                        </td>
                        <td>
                            <span class="badge badge-completed">{{ $item->quantity }}</span>
                        </td>
                        <td>
                            <div class="text-success fw-700" style="font-size: 0.95rem;">৳{{ number_format($item->subtotal, 2) }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Update Status Form -->
        <div class="permission-title" style="margin-top: 2.5rem;">
            <i class="fas fa-edit me-2" style="color: var(--accent-blue);"></i>Update Order Status
        </div>

        <form action="{{ route('admin.ecommerce.orders.update', $order) }}" method="POST" class="status-update-form">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Order Status Selection -->
                <div class="col-md-6">
                    <label class="status-form-label">
                        <i class="fas fa-box me-2"></i>Order Status
                    </label>
                    <div class="status-options-grid">
                        <label class="status-option @if($order->status === 'pending') active @endif" data-status="pending">
                            <input type="radio" name="status" value="pending" @if($order->status === 'pending') checked @endif>
                            <div class="status-option-content">
                                <div class="status-icon pending">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="status-info">
                                    <span class="status-name">Pending</span>
                                    <span class="status-desc">Awaiting processing</span>
                                </div>
                            </div>
                        </label>

                        <label class="status-option @if($order->status === 'processing') active @endif" data-status="processing">
                            <input type="radio" name="status" value="processing" @if($order->status === 'processing') checked @endif>
                            <div class="status-option-content">
                                <div class="status-icon processing">
                                    <i class="fas fa-cog fa-spin"></i>
                                </div>
                                <div class="status-info">
                                    <span class="status-name">Processing</span>
                                    <span class="status-desc">Preparing order</span>
                                </div>
                            </div>
                        </label>

                        <label class="status-option @if($order->status === 'shipped') active @endif" data-status="shipped">
                            <input type="radio" name="status" value="shipped" @if($order->status === 'shipped') checked @endif>
                            <div class="status-option-content">
                                <div class="status-icon shipped">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="status-info">
                                    <span class="status-name">Shipped</span>
                                    <span class="status-desc">On the way</span>
                                </div>
                            </div>
                        </label>

                        <label class="status-option @if($order->status === 'delivered') active @endif" data-status="delivered">
                            <input type="radio" name="status" value="delivered" @if($order->status === 'delivered') checked @endif>
                            <div class="status-option-content">
                                <div class="status-icon delivered">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="status-info">
                                    <span class="status-name">Delivered</span>
                                    <span class="status-desc">Order completed</span>
                                </div>
                            </div>
                        </label>

                        <label class="status-option @if($order->status === 'cancelled') active @endif" data-status="cancelled">
                            <input type="radio" name="status" value="cancelled" @if($order->status === 'cancelled') checked @endif>
                            <div class="status-option-content">
                                <div class="status-icon cancelled">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="status-info">
                                    <span class="status-name">Cancelled</span>
                                    <span class="status-desc">Order cancelled</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Payment Status Selection -->
                <div class="col-md-6">
                    <label class="status-form-label">
                        <i class="fas fa-credit-card me-2"></i>Payment Status
                    </label>
                    <div class="status-options-grid">
                        <label class="payment-option @if($order->payment_status === 'pending') active @endif">
                            <input type="radio" name="payment_status" value="pending" @if($order->payment_status === 'pending') checked @endif>
                            <div class="payment-option-content">
                                <div class="payment-badge payment-pending">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <span>Pending</span>
                            </div>
                        </label>

                        <label class="payment-option @if($order->payment_status === 'paid') active @endif">
                            <input type="radio" name="payment_status" value="paid" @if($order->payment_status === 'paid') checked @endif>
                            <div class="payment-option-content">
                                <div class="payment-badge payment-paid">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span>Paid</span>
                            </div>
                        </label>

                        <label class="payment-option @if($order->payment_status === 'failed') active @endif">
                            <input type="radio" name="payment_status" value="failed" @if($order->payment_status === 'failed') checked @endif>
                            <div class="payment-option-content">
                                <div class="payment-badge payment-failed">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <span>Failed</span>
                            </div>
                        </label>

                        <label class="payment-option @if($order->payment_status === 'refunded') active @endif">
                            <input type="radio" name="payment_status" value="refunded" @if($order->payment_status === 'refunded') checked @endif>
                            <div class="payment-option-content">
                                <div class="payment-badge payment-refunded">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <span>Refunded</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="status-submit-btn">
                        <i class="fas fa-save me-2"></i>Update Order Status
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
/* Status Update Form */
.status-update-form {
    background: rgba(15, 23, 42, 0.6);
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.05);
    padding: 2rem;
    backdrop-filter: blur(10px);
}

.status-form-label {
    display: flex;
    align-items: center;
    color: rgba(255,255,255,0.7);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
    text-transform: uppercase;
}

/* Order Status Options Grid */
.status-options-grid {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.status-option {
    display: flex;
    cursor: pointer;
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.status-option::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.status-option:hover::before {
    opacity: 1;
}

.status-option:hover {
    border-color: rgba(59, 130, 246, 0.3);
    transform: translateX(5px);
    box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);
}

.status-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.status-option.active {
    border-color: rgba(59, 130, 246, 0.4);
    background: rgba(59, 130, 246, 0.08);
}

.status-option.active::before {
    opacity: 1;
}

/* Status Option Content */
.status-option-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    width: 100%;
    position: relative;
    z-index: 1;
}

.status-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.status-icon.pending {
    background: rgba(251, 191, 36, 0.15);
    color: #fbbf24;
    border: 1px solid rgba(251, 191, 36, 0.3);
}

.status-icon.processing {
    background: rgba(59, 130, 246, 0.15);
    color: var(--accent-blue);
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.status-icon.shipped {
    background: rgba(168, 85, 247, 0.15);
    color: #a855f7;
    border: 1px solid rgba(168, 85, 247, 0.3);
}

.status-icon.delivered {
    background: rgba(34, 197, 94, 0.15);
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.status-icon.cancelled {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.status-option:hover .status-icon {
    transform: scale(1.1);
}

.status-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.status-name {
    color: #fff;
    font-weight: 600;
    font-size: 0.95rem;
}

.status-desc {
    color: rgba(255,255,255,0.5);
    font-size: 0.8rem;
}

/* Payment Status Options */
.payment-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    padding: 0.85rem 1rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.payment-option:hover {
    border-color: rgba(59, 130, 246, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.1);
}

.payment-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.payment-option.active {
    border-color: rgba(59, 130, 246, 0.4);
    background: rgba(59, 130, 246, 0.08);
}

.payment-option-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    width: 100%;
}

.payment-badge {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.payment-badge.payment-pending {
    background: rgba(251, 191, 36, 0.15);
    color: #fbbf24;
}

.payment-badge.payment-paid {
    background: rgba(34, 197, 94, 0.15);
    color: #22c55e;
}

.payment-badge.payment-failed {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
}

.payment-badge.payment-refunded {
    background: rgba(168, 85, 247, 0.15);
    color: #a855f7;
}

.payment-option:hover .payment-badge {
    transform: scale(1.1);
}

.payment-option span {
    color: rgba(255,255,255,0.8);
    font-weight: 500;
    font-size: 0.9rem;
}

/* Submit Button */
.status-submit-btn {
    width: 100%;
    padding: 1rem 2rem;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
    border: none;
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    position: relative;
    overflow: hidden;
}

.status-submit-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
}

.status-submit-btn:hover::before {
    width: 300px;
    height: 300px;
}

.status-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(59, 130, 246, 0.4);
}

.status-submit-btn:active {
    transform: translateY(0);
}

.status-submit-btn i {
    position: relative;
    z-index: 1;
}

/* Spin animation for processing icon */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.fa-spin {
    animation: spin 2s linear infinite;
}

/* Pulse animation for active status */
@keyframes status-pulse {
    0%, 100% {
        box-shadow: 0 0 5px rgba(59, 130, 246, 0.3),
                    0 0 10px rgba(59, 130, 246, 0.2);
    }
    50% {
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.4),
                    0 0 25px rgba(59, 130, 246, 0.3);
    }
}

.status-option.active {
    animation: status-pulse 2s ease-in-out infinite;
}

/* Responsive Design */
@media (max-width: 768px) {
    .status-update-form {
        padding: 1.5rem;
    }

    .status-icon {
        width: 38px;
        height: 38px;
        font-size: 1rem;
    }

    .status-name {
        font-size: 0.9rem;
    }

    .status-desc {
        font-size: 0.75rem;
    }

    .payment-badge {
        width: 28px;
        height: 28px;
        font-size: 0.85rem;
    }

    .payment-option span {
        font-size: 0.85rem;
    }
}
</style>
@endpush
@endsection
