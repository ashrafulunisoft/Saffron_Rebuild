@extends('layouts.admin')

@section('title', 'Orders - Saffron Admin')

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
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Orders</h2>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-2">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Total</h6>
                            <h3 class="text-white fw-800 mb-0" style="font-size: 1.5rem;">{{ $stats['total'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2); width: 40px; height: 40px; font-size: 1rem;">
                            <i class="fas fa-shopping-cart" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Pending</h6>
                            <h3 class="text-white fw-800 mb-0" style="font-size: 1.5rem;">{{ $stats['pending'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2); width: 40px; height: 40px; font-size: 1rem;">
                            <i class="fas fa-clock" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Processing</h6>
                            <h3 class="text-white fw-800 mb-0" style="font-size: 1.5rem;">{{ $stats['processing'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2); width: 40px; height: 40px; font-size: 1rem;">
                            <i class="fas fa-cog" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Shipped</h6>
                            <h3 class="text-white fw-800 mb-0" style="font-size: 1.5rem;">{{ $stats['shipped'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2); width: 40px; height: 40px; font-size: 1rem;">
                            <i class="fas fa-truck" style="color: #a855f7;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Delivered</h6>
                            <h3 class="text-white fw-800 mb-0" style="font-size: 1.5rem;">{{ $stats['delivered'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(34, 197, 94, 0.2); width: 40px; height: 40px; font-size: 1rem;">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.75rem; opacity: 0.7;">Cancelled</h6>
                            <h3 class="text-white fw-800 mb-0" style="font-size: 1.5rem;">{{ $stats['cancelled'] }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.2); width: 40px; height: 40px; font-size: 1rem;">
                            <i class="fas fa-times-circle" style="color: #ef4444;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row g-3 mb-4" style="background: rgba(15, 23, 42, 0.6); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
            <div class="col-md-6">
                <div class="position-relative">
                    <input type="text" id="orderSearch" class="input-dark input-custom" placeholder="Search orders..." style="color: white;">
                    <i class="fas fa-search input-icon"></i>
                </div>
            </div>
            <div class="col-md-6">
                <select class="input-dark input-custom" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="table-responsive">
            <table class="table-custom" id="ordersTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $order)
                    <tr>
                        <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td>
                        <td>
                            <div>
                                <code style="font-size: 0.85rem;">{{ $order->order_number }}</code>
                            </div>
                            <div style="font-size: 0.7rem; opacity: 0.5; margin-top: 0.25rem;">{{ $order->created_at->format('M d, Y') }}</div>
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
                            <span class="badge badge-completed">{{ $order->order_items_count }} items</span>
                        </td>
                        <td>
                            <div style="font-size: 0.9rem;">৳{{ number_format($order->final_amount, 2) }}</div>
                        </td>
                        <td>
                            @if($order->payment_status === 'paid')
                                <span class="badge badge-approved">Paid</span>
                            @elseif($order->payment_status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($order->payment_status === 'failed')
                                <span class="badge badge-cancelled">Failed</span>
                            @else
                                <span class="badge badge-completed">Refunded</span>
                            @endif
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
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.orders.show', $order) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                                    <button onclick="updateOrderStatus({{ $order->id }}, 'processing')" class="action-btn btn-visit-type" title="Mark Processing" style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue);">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <button onclick="updateOrderStatus({{ $order->id }}, 'shipped')" class="action-btn" title="Mark Shipped" style="background: rgba(168, 85, 247, 0.2); color: #a855f7;">
                                        <i class="fas fa-truck"></i>
                                    </button>
                                    <button onclick="updateOrderStatus({{ $order->id }}, 'delivered')" class="action-btn btn-approve" title="Mark Delivered">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif
                                @if($order->status === 'pending' || $order->status === 'cancelled')
                                    <button onclick="deleteOrder({{ $order->id }}, '{{ $order->order_number }}')" class="action-btn btn-delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-shopping-bag" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No orders found</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                Showing {{ ($orders->currentPage() - 1) * $orders->perPage() + 1 }}
                to {{ min($orders->currentPage() * $orders->perPage(), $orders->total()) }}
                of {{ $orders->total() }} orders
            </div>
            {{ $orders->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function updateOrderStatus(orderId, newStatus) {
    const statusText = {
        'pending': 'Pending',
        'processing': 'Processing',
        'shipped': 'Shipped',
        'delivered': 'Delivered',
        'cancelled': 'Cancelled'
    };

    Swal.fire({
        title: 'Update Status?',
        text: `Change order status to "${statusText[newStatus]}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, update!',
        cancelButtonText: 'Cancel',
        background: '#0f172a',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/ecommerce/orders/${orderId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: newStatus,
                    payment_status: 'pending'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Order status updated successfully!',
                        timer: 1500,
                        showConfirmButton: false,
                        background: '#0f172a',
                        color: '#fff'
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong.',
                    background: '#0f172a',
                    color: '#fff'
                });
            });
        }
    });
}

function deleteOrder(orderId, orderNumber) {
    Swal.fire({
        title: 'Delete Order?',
        text: `Are you sure you want to delete "${orderNumber}"? This action cannot be undone.`,
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
            window.location.href = `/admin/ecommerce/orders/${orderId}`;
        }
    });
}
</script>
@endpush

@push('styles')
@include('admin.ecommerce.partials.common-styles')
@endpush
@endsection
