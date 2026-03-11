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
        <div class="permission-title" style="margin-top: 2.5rem;">Update Order Status</div>
        <form action="{{ route('admin.ecommerce.orders.update', $order) }}" method="POST" style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Order Status</label>
                    <select name="status" class="input-dark input-custom">
                        <option value="pending" @if($order->status === 'pending') selected @endif>Pending</option>
                        <option value="processing" @if($order->status === 'processing') selected @endif>Processing</option>
                        <option value="shipped" @if($order->status === 'shipped') selected @endif>Shipped</option>
                        <option value="delivered" @if($order->status === 'delivered') selected @endif>Delivered</option>
                        <option value="cancelled" @if($order->status === 'cancelled') selected @endif>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="input-dark input-custom">
                        <option value="pending" @if($order->payment_status === 'pending') selected @endif>Pending</option>
                        <option value="paid" @if($order->payment_status === 'paid') selected @endif>Paid</option>
                        <option value="failed" @if($order->payment_status === 'failed') selected @endif>Failed</option>
                        <option value="refunded" @if($order->payment_status === 'refunded') selected @endif>Refunded</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn-gradient" style="width: 100%; padding: 0.75rem 2rem; border-radius: 100px;">
                        <i class="fas fa-save me-2"></i>Update Status
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')
@endpush
@endsection
