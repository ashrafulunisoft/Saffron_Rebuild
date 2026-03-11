@extends('layouts.admin')

@section('title', 'Orders - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Orders <span class="text-white">অর্ডার</span></h2>
        <p class="text-white mb-0">Manage customer orders and track shipments</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-2 mb-3">
        <div class="card bg-dark border-secondary">
            <div class="card-body text-center">
                <h6 class="text-white-50 mb-2">Total / মোট</h6>
                <h3 class="fw-bold text-primary mb-0">{{ $stats['total'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-3">
        <div class="card bg-dark border-secondary">
            <div class="card-body text-center">
                <h6 class="text-white-50 mb-2">Pending / মুলতুম্বর</h6>
                <h3 class="fw-bold text-warning mb-0">{{ $stats['pending'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-3">
        <div class="card bg-dark border-secondary">
            <div class="card-body text-center">
                <h6 class="text-white-50 mb-2">Processing / প্রক্রিয়া</h6>
                <h3 class="fw-bold text-info mb-0">{{ $stats['processing'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-3">
        <div class="card bg-dark border-secondary">
            <div class="card-body text-center">
                <h6 class="text-white-50 mb-2">Shipped / পাঠানো হয়েছে</h6>
                <h3 class="fw-bold text-primary mb-0">{{ $stats['shipped'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-3">
        <div class="card bg-dark border-secondary">
            <div class="card-body text-center">
                <h6 class="text-white-50 mb-2">Delivered / বিতরণ করা হয়েছে</h6>
                <h3 class="fw-bold text-success mb-0">{{ $stats['delivered'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-3">
        <div class="card bg-dark border-secondary">
            <div class="card-body text-center">
                <h6 class="text-white-50 mb-2">Cancelled / বাতিল</h6>
                <h3 class="fw-bold text-danger mb-0">{{ $stats['cancelled'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="glass-card">
    <!-- Search and Filter -->
    <div class="row mb-4 p-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-dark text-white border-secondary">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="orderSearch" class="form-control bg-dark text-white border-secondary" placeholder="Search orders... / অর্ডার খুঁজুন..." style="color: white;">
            </div>
            <style>
                #orderSearch::placeholder {
                    color: #adb5bd !important;
                    opacity: 1 !important;
                }
                #orderSearch::-webkit-input-placeholder {
                    color: #adb5bd !important;
                }
                #orderSearch::-moz-placeholder {
                    color: #adb5bd !important;
                    opacity: 1 !important;
                }
            </style>
        </div>
        <div class="col-md-6 text-end">
            <select class="form-select bg-dark text-white border-secondary d-inline-block" id="statusFilter" style="width: auto;">
                <option value="">All Status / সকল স্থিতি</option>
                <option value="pending">Pending / মুলতুম্বর</option>
                <option value="processing">Processing / প্রক্রিয়া</option>
                <option value="shipped">Shipped / পাঠানো হয়েছে</option>
                <option value="delivered">Delivered / বিতরণ করা হয়েছে</option>
                <option value="cancelled">Cancelled / বাতিল</option>
            </select>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive p-4">
        <table class="table table-hover table-dark" id="ordersTable" style="background: transparent !important;">
            <thead class="table-dark">
                <tr>
                    <th class="text-white" style="border-color: #495057 !important;">Order #</th>
                    <th class="text-white" style="border-color: #495057 !important;">Customer</th>
                    <th class="text-white" style="border-color: #495057 !important;">Items</th>
                    <th class="text-white" style="border-color: #495057 !important;">Amount</th>
                    <th class="text-white" style="border-color: #495057 !important;">Payment</th>
                    <th class="text-white" style="border-color: #495057 !important;">Status</th>
                    <th class="text-white" style="border-color: #495057 !important;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr style="border-color: #495057 !important;">
                        <td>
                            <code class="text-warning">{{ $order->order_number }}</code>
                            <br><small class="text-white-50">{{ $order->created_at->format('M d, Y') }}</small>
                        </td>
                        <td>
                            <div class="fw-bold text-white">{{ $order->user->name ?? 'Guest' }}</div>
                            <small class="text-info">{{ $order->user->email ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $order->order_items_count }} items</span>
                        </td>
                        <td>
                            <span class="text-white fs-6 fw-bold">৳{{ number_format($order->final_amount, 2) }}</span>
                        </td>
                        <td>
                            @if($order->payment_status === 'paid')
                                <span class="badge bg-success">Paid</span>
                            @elseif($order->payment_status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($order->payment_status === 'failed')
                                <span class="badge bg-danger">Failed</span>
                            @else
                                <span class="badge bg-info">Refunded</span>
                            @endif
                        </td>
                        <td>
                            @if($order->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($order->status === 'processing')
                                <span class="badge bg-info">Processing</span>
                            @elseif($order->status === 'shipped')
                                <span class="badge bg-primary">Shipped</span>
                            @elseif($order->status === 'delivered')
                                <span class="badge bg-success">Delivered</span>
                            @elseif($order->status === 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.ecommerce.orders.show', $order) }}"
                                   class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                                    <button onclick="updateOrderStatus({{ $order->id }}, 'processing')"
                                            class="btn btn-sm btn-secondary" title="Mark as Processing">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <button onclick="updateOrderStatus({{ $order->id }}, 'shipped')"
                                            class="btn btn-sm btn-primary" title="Mark as Shipped">
                                        <i class="fas fa-truck"></i>
                                    </button>
                                    <button onclick="updateOrderStatus({{ $order->id }}, 'delivered')"
                                            class="btn btn-sm btn-success" title="Mark as Delivered">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif
                                @if($order->status === 'pending' || $order->status === 'cancelled')
                                    <button onclick="deleteOrder({{ $order->id }}, '{{ $order->order_number }}')"
                                            class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-shopping-bag text-white-50 fs-1 mb-3 d-block"></i>
                                <p class="text-white">No orders found / কোন অর্ডার পাওয়া যায়নি</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="d-flex justify-content-center p-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>

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
        title: 'Update Order Status?',
        html: `Change order status to <strong>${statusText[newStatus]}</strong>?<br>আপনি কি অর্ডারের স্থিতি পরিবর্তন করতে চান?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, update!',
        cancelButtonText: 'Cancel'
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
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong.'
                });
            });
        }
    });
}

function deleteOrder(orderId, orderNumber) {
    Swal.fire({
        title: 'Are you sure?',
        html: `You want to delete order <strong>${orderNumber}</strong>?<br>আপনি কি <strong>${orderNumber}</strong> অর্ডার মুছে ফেলতে চান?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#3b82f6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/ecommerce/orders/${orderId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || !data.error) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Order has been deleted.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Cannot delete this order.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong.'
                });
            });
        }
    });
}

// Search functionality
document.getElementById('orderSearch')?.addEventListener('keyup', function(e) {
    const searchValue = e.target.value.toLowerCase();
    const table = document.getElementById('ordersTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const orderNumber = rows[i].getElementsByTagName('td')[0]?.textContent.toLowerCase() || '';
        const customer = rows[i].getElementsByTagName('td')[1]?.textContent.toLowerCase() || '';

        if (orderNumber.includes(searchValue) || customer.includes(searchValue)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});

// Status filter
document.getElementById('statusFilter')?.addEventListener('change', function(e) {
    const status = e.target.value;
    const table = document.getElementById('ordersTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        if (!status) {
            rows[i].style.display = '';
        } else {
            const statusCell = rows[i].getElementsByTagName('td')[6];
            const orderStatus = statusCell?.textContent.toLowerCase() || '';

            if (orderStatus.includes(status.toLowerCase())) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
});
</script>
@endsection
