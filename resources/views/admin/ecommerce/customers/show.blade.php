@extends('layouts.admin')

@section('title', "Customer - {$customer->name}")

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">CUSTOMER MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Customer Details</h2>
                <a href="{{ route('admin.ecommerce.customers.index') }}" class="btn-outline" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Customer Profile -->
            <div class="col-md-4">
                <div class="permission-title">Customer Profile</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 2rem; text-align: center;">
                    <div class="avatar-circle mx-auto mb-4" style="width: 100px; height: 100px; font-size: 2.5rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">
                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                    </div>
                    <h3 class="text-white fw-800 mb-2" style="font-size: 1.5rem;">{{ $customer->name }}</h3>
                    <p style="color: var(--accent-blue); margin-bottom: 1rem;">{{ $customer->email }}</p>

                    @if($customer->banned ?? false)
                        <span class="badge badge-cancelled" style="font-size: 0.8rem;">Banned Account</span>
                    @elseif($customer->email_verified_at)
                        <span class="badge badge-approved" style="font-size: 0.8rem;">Verified Account</span>
                    @else
                        <span class="badge badge-pending" style="font-size: 0.8rem;">Unverified</span>
                    @endif

                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div style="background: rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 1rem;">
                                <i class="fas fa-shopping-cart" style="color: var(--accent-blue); font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                <div class="text-white fw-800" style="font-size: 1.5rem;">{{ $totalOrders }}</div>
                                <div style="font-size: 0.7rem; opacity: 0.6;">Total Orders</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background: rgba(34, 197, 94, 0.2); border-radius: 12px; padding: 1rem;">
                                <i class="fas fa-wallet" style="color: #22c55e; font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                <div class="text-white fw-800" style="font-size: 1.5rem;">৳{{ number_format($totalSpent, 0) }}</div>
                                <div style="font-size: 0.7rem; opacity: 0.6;">Total Spent</div>
                            </div>
                        </div>
                    </div>

                    @if($customer->phone)
                        <div class="mt-4" style="background: rgba(15, 23, 42, 0.4); border-radius: 12px; padding: 1rem;">
                            <label class="text-muted" style="font-size: 0.75rem;">PHONE</label>
                            <div class="text-white" style="font-size: 0.9rem;">{{ $customer->phone }}</div>
                        </div>
                    @endif

                    @if($customer->address)
                        <div class="mt-3" style="background: rgba(15, 23, 42, 0.4); border-radius: 12px; padding: 1rem;">
                            <label class="text-muted" style="font-size: 0.75rem;">ADDRESS</label>
                            <div class="text-white" style="font-size: 0.85rem;">{{ $customer->address }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Statistics & Actions -->
            <div class="col-md-8">
                <div class="permission-title">Order Statistics</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Total</h6>
                                <h3 class="text-white fw-800 mb-0" style="font-size: 1.8rem;">{{ $totalOrders }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Pending</h6>
                                <h3 class="text-white fw-800 mb-0" style="font-size: 1.8rem;">{{ $pendingOrders }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Completed</h6>
                                <h3 class="text-white fw-800 mb-0" style="font-size: 1.8rem;">{{ $completedOrders }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Cancelled</h6>
                                <h3 class="text-white fw-800 mb-0" style="font-size: 1.8rem;">{{ $cancelledOrders }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="permission-title">Account Actions</div>
                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                    <div class="row g-3">
                        @if($customer->banned ?? false)
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}" onsubmit="return confirm('Unban this customer?');">
                                    @csrf
                                    <button type="submit" class="btn-gradient" style="width: 100%; padding: 0.75rem 2rem; border-radius: 100px; background: linear-gradient(135deg, #22c55e, #10b981);">
                                        <i class="fas fa-unlock me-2"></i>Unban Customer
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}" onsubmit="return confirm('Ban this customer?');">
                                    @csrf
                                    <button type="submit" class="btn-gradient" style="width: 100%; padding: 0.75rem 2rem; border-radius: 100px; background: linear-gradient(135deg, #ef4444, #dc2626);">
                                        <i class="fas fa-ban me-2"></i>Ban Customer
                                    </button>
                                </form>
                            </div>
                        @endif

                        @if($customer->orders()->count() === 0)
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('admin.ecommerce.customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-outline" style="width: 100%; padding: 0.75rem 2rem; border-radius: 100px;">
                                        <i class="fas fa-trash me-2"></i>Delete Account
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 p-3 rounded" style="background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.3);">
                        <i class="fas fa-info-circle" style="color: #fbbf24; margin-right: 0.5rem;"></i>
                        <span style="font-size: 0.85rem; opacity: 0.8;">
                            @if($customer->orders()->count() > 0)
                                This customer has {{ $totalOrders }} order(s) and cannot be deleted. Use the ban option to restrict access.
                            @else
                                This customer has no orders and can be safely deleted.
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order History -->
        <div class="permission-title">Order History ({{ $orders->count() }})</div>
        @if($orders->count() > 0)
            <div class="table-responsive mb-5" style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
                <table class="table-custom" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <code style="font-size: 0.85rem;">{{ $order->order_number }}</code>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem;">{{ $order->created_at->format('M d, Y') }}</div>
                            </td>
                            <td>
                                <span class="badge badge-visit-type">{{ $order->orderItems->count() }} items</span>
                            </td>
                            <td>
                                <div class="text-success fw-700" style="font-size: 0.95rem;">৳{{ number_format($order->final_amount, 2) }}</div>
                            </td>
                            <td>
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

            @if($orders->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->appends(['customer' => $customer->id])->links('vendor.pagination.bootstrap-5') }}
                </div>
            @endif
        @else
            <div class="text-center py-5 mb-5" style="background: rgba(15, 23, 42, 0.4); border-radius: 16px;">
                <i class="fas fa-box-open" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                <div class="text-white" style="opacity: 0.5;">No orders yet</div>
            </div>
        @endif

        <!-- Reviews -->
        @if($reviews->count() > 0)
            <div class="permission-title">Recent Reviews ({{ $reviews->count() }})</div>
            <div class="row g-4">
                @foreach($reviews as $review)
                    <div class="col-md-6">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span style="color: #fbbf24; margin-right: 0.5rem;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    <span style="font-size: 0.8rem; opacity: 0.6;">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                                @if(!$review->is_approved)
                                    <span class="badge badge-pending">Pending</span>
                                @endif
                            </div>
                            <h6 class="text-white fw-600 mb-2" style="font-size: 0.95rem;">{{ $review->product->name_en }}</h6>
                            <p style="font-size: 0.85rem; opacity: 0.7; margin: 0;">{{ Str::limit($review->comment, 100) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')
@endpush
@endsection
