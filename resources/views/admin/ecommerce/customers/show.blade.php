@extends('layouts.admin')

@section('title', "Customer Details - {$customer->name}")

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">{{ $customer->name }} <span class="text-white">গ্রাহকের বিবরণ</span></h2>
        <p class="text-white mb-0">Customer account details and order history</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.customers.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left me-2"></i> Back to Customers
        </a>
    </div>
</div>

<!-- Customer Profile Card -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="glass-card h-100">
            <div class="card-header bg-primary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-user me-2"></i>Customer Profile</h5>
            </div>
            <div class="card-body bg-dark">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-gradient text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 100px; height: 100px; font-size: 40px;">
                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                    </div>
                    <h4 class="fw-bold text-white">{{ $customer->name }}</h4>
                    <p class="text-info mb-0">{{ $customer->email }}</p>
                    @if($customer->banned ?? false)
                        <span class="badge bg-danger mt-2">Banned Account</span>
                    @elseif($customer->email_verified_at)
                        <span class="badge bg-success mt-2">Verified Account</span>
                    @else
                        <span class="badge bg-warning mt-2">Unverified</span>
                    @endif
                </div>

                <div class="row g-3">
                    <div class="col-6">
                        <div class="card bg-secondary border-0">
                            <div class="card-body text-center">
                                <i class="fas fa-shopping-cart text-white fs-4 mb-2"></i>
                                <h3 class="fw-bold text-white mb-0">{{ $totalOrders }}</h3>
                                <small class="text-white-50">Total Orders</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-success border-0">
                            <div class="card-body text-center">
                                <i class="fas fa-wallet text-white fs-4 mb-2"></i>
                                <h3 class="fw-bold text-white mb-0">৳{{ number_format($totalSpent, 0) }}</h3>
                                <small class="text-white-50">Total Spent</small>
                            </div>
                        </div>
                    </div>
                </div>

                @if($pointsBalance > 0)
                    <div class="alert alert-info mt-3 mb-0">
                        <i class="fas fa-coins me-2"></i>
                        <strong>Reward Points:</strong> {{ $pointsBalance }} points
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Order Statistics -->
        <div class="glass-card mb-4">
            <div class="card-header bg-success border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-chart-pie me-2"></i>Order Statistics</h5>
            </div>
            <div class="card-body bg-dark">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="p-3 rounded bg-primary bg-opacity-25 border border-primary">
                            <i class="fas fa-list text-primary fs-3 mb-2"></i>
                            <h4 class="fw-bold text-white mb-0">{{ $totalOrders }}</h4>
                            <small class="text-muted">Total Orders</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded bg-warning bg-opacity-25 border border-warning">
                            <i class="fas fa-clock text-warning fs-3 mb-2"></i>
                            <h4 class="fw-bold text-white mb-0">{{ $pendingOrders }}</h4>
                            <small class="text-muted">Pending</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded bg-success bg-opacity-25 border border-success">
                            <i class="fas fa-check-circle text-success fs-3 mb-2"></i>
                            <h4 class="fw-bold text-white mb-0">{{ $completedOrders }}</h4>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded bg-danger bg-opacity-25 border border-danger">
                            <i class="fas fa-times-circle text-danger fs-3 mb-2"></i>
                            <h4 class="fw-bold text-white mb-0">{{ $cancelledOrders }}</h4>
                            <small class="text-muted">Cancelled</small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <div class="alert alert-success mb-0">
                        <i class="fas fa-receipt me-2"></i>
                        <strong>Average Order Value:</strong> ৳{{ number_format($averageOrderValue, 2) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Actions -->
        <div class="glass-card">
            <div class="card-header bg-warning border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-cogs me-2"></i>Account Actions</h5>
            </div>
            <div class="card-body bg-dark">
                <div class="row g-3">
                    @if($customer->banned ?? false)
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}" onsubmit="return confirm('Unban this customer? They will be able to place orders again.');">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-unlock me-2"></i>Unban Customer / আনব্যান করুন
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}" onsubmit="return confirm('Ban this customer? They will not be able to place orders or access their account.');">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-ban me-2"></i>Ban Customer / নিষিদ্ধ করুন
                                </button>
                            </form>
                        </div>
                    @endif

                    @if($customer->orders()->count() === 0)
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.ecommerce.customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-trash me-2"></i>Delete Account
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong>
                    @if($customer->orders()->count() > 0)
                        This customer has {{ $totalOrders }} order(s) and cannot be deleted. Use the ban option to restrict access.
                    @else
                        This customer has no orders and can be safely deleted.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order History -->
<div class="glass-card mb-4">
    <div class="card-header bg-info border-secondary">
        <h5 class="mb-0 text-white">
            <i class="fas fa-shopping-bag me-2"></i>Order History ({{ $totalOrders }})
        </h5>
    </div>
    <div class="card-body bg-dark">
        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th class="text-white">Order #</th>
                            <th class="text-white">Date</th>
                            <th class="text-white">Items</th>
                            <th class="text-white">Total</th>
                            <th class="text-white">Status</th>
                            <th class="text-white text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><code class="text-warning">{{ $order->order_number }}</code></td>
                                <td><span class="text-white">{{ $order->created_at->format('M d, Y') }}</span></td>
                                <td><span class="badge bg-secondary">{{ $order->items->count() }} items</span></td>
                                <td><span class="text-success fw-bold">৳{{ number_format($order->final_amount, 2) }}</span></td>
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
                                <td class="text-end">
                                    <a href="{{ route('admin.ecommerce.orders.show', $order) }}" class="btn btn-sm btn-outline-light">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->appends(['customer' => $customer->id])->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open text-muted fs-1 mb-3 d-block"></i>
                <p class="text-white">No orders yet / এখনও কোনো অর্ডার নেই</p>
                <small class="text-muted">Customer's order history will appear here</small>
            </div>
        @endif
    </div>
</div>

<!-- Reviews -->
@if($reviews->count() > 0)
    <div class="glass-card">
        <div class="card-header bg-secondary border-secondary">
            <h5 class="mb-0 text-white">
                <i class="fas fa-star me-2"></i>Recent Reviews ({{ $reviews->count() }})
            </h5>
        </div>
        <div class="card-body bg-dark">
            <div class="row">
                @foreach($reviews as $review)
                    <div class="col-md-6 mb-3">
                        <div class="card bg-secondary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge bg-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                </div>
                                <h6 class="text-white mb-1">{{ $review->product->name_en }}</h6>
                                <p class="text-white-50 small mb-2">{{ Str::limit($review->comment, 100) }}</p>
                                @if(!$review->is_approved)
                                    <span class="badge bg-danger">Pending Approval</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@endsection
