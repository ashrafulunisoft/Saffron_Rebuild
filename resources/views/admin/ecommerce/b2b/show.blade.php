@extends('layouts.admin')

@section('title', "{$b2b->company_name} - B2B Customer")

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">{{ $b2b->company_name }} <span class="text-white">বিস্তারিত</span></h2>
        <p class="text-white mb-0">B2B customer details and order history</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.b2b.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left me-2"></i> Back to B2B Customers
        </a>
        <a href="{{ route('admin.ecommerce.b2b.edit', $b2b) }}" class="btn btn-gradient ms-2">
            <i class="fas fa-edit me-2"></i> Edit
        </a>
    </div>
</div>

<!-- Company Info Card -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="glass-card h-100">
            <div class="card-header bg-primary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-building me-2"></i>Company Information</h5>
            </div>
            <div class="card-body bg-dark">
                <div class="mb-3">
                    <label class="text-muted small">Company Name</label>
                    <div class="text-white fw-bold">{{ $b2b->company_name }}</div>
                </div>
                @if($b2b->trade_license_number)
                    <div class="mb-3">
                        <label class="text-muted small">Trade License</label>
                        <div class="text-white">{{ $b2b->trade_license_number }}</div>
                    </div>
                @endif
                @if($b2b->tax_id)
                    <div class="mb-3">
                        <label class="text-muted small">Tax ID</label>
                        <div class="text-white">{{ $b2b->tax_id }}</div>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="text-muted small">Business Type</label>
                    <div><span class="badge bg-secondary text-uppercase">{{ $b2b->business_type }}</span></div>
                </div>
                <div>
                    <label class="text-muted small">Status</label>
                    <div>
                        @if($b2b->approval_status === 'pending')
                            <span class="badge bg-warning">Pending Approval</span>
                        @elseif($b2b->approval_status === 'approved')
                            @if($b2b->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass-card h-100">
            <div class="card-header bg-info border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-user-tie me-2"></i>Contact Information</h5>
            </div>
            <div class="card-body bg-dark">
                @if($b2b->contact_person)
                    <div class="mb-3">
                        <label class="text-muted small">Contact Person</label>
                        <div class="text-white">{{ $b2b->contact_person }}</div>
                    </div>
                @endif
                @if($b2b->contact_email)
                    <div class="mb-3">
                        <label class="text-muted small">Contact Email</label>
                        <div class="text-white">{{ $b2b->contact_email }}</div>
                    </div>
                @endif
                @if($b2b->contact_phone)
                    <div class="mb-3">
                        <label class="text-muted small">Contact Phone</label>
                        <div class="text-white">{{ $b2b->contact_phone }}</div>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="text-muted small">Account Email</label>
                    <div class="text-white">{{ $b2b->user->email }}</div>
                </div>
                @if($b2b->approved_at)
                    <div>
                        <label class="text-muted small">Approved On</label>
                        <div class="text-white">{{ $b2b->approved_at->format('M d, Y') }}</div>
                        <small class="text-muted">by {{ $b2b->approver->name ?? 'System' }}</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass-card h-100">
            <div class="card-header bg-success border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-wallet me-2"></i>Credit & Pricing</h5>
            </div>
            <div class="card-body bg-dark">
                <div class="row text-center mb-3">
                    <div class="col-6">
                        <div class="alert alert-primary mb-0">
                            <small class="text-muted">Credit Limit</small>
                            <div class="fw-bold text-white fs-5">৳{{ number_format($b2b->credit_limit, 0) }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="alert alert-warning mb-0">
                            <small class="text-muted">Current Balance</small>
                            <div class="fw-bold text-white fs-5">৳{{ number_format($b2b->current_balance, 0) }}</div>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <small class="text-muted">Available Credit</small>
                    <div class="fw-bold {{ $b2b->available_credit > 0 ? 'text-success' : 'text-danger' }} fs-4">
                        ৳{{ number_format($b2b->available_credit, 0) }}
                    </div>
                </div>
                <hr class="border-secondary">
                <div class="row text-center">
                    <div class="col-6">
                        <small class="text-muted">Wholesale Discount</small>
                        <div class="fw-bold text-success">{{ $b2b->wholesale_discount }}%</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Pricing Tier</small>
                        <div class="fw-bold text-info">{{ ucfirst($b2b->pricing_tier) }}</div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <small class="text-muted">Payment Terms</small>
                    <div class="text-white">{{ str_replace('_', ' ', ucfirst($b2b->payment_terms)) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                <div class="p-3 rounded bg-info bg-opacity-25 border border-info">
                    <i class="fas fa-wallet text-info fs-3 mb-2"></i>
                    <h4 class="fw-bold text-white mb-0">৳{{ number_format($totalPurchase, 0) }}</h4>
                    <small class="text-muted">Total Purchase</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Actions -->
<div class="glass-card mb-4">
    <div class="card-header bg-warning border-secondary">
        <h5 class="mb-0 text-white"><i class="fas fa-cogs me-2"></i>Actions</h5>
    </div>
    <div class="card-body bg-dark">
        <div class="row g-3">
            @if($b2b->approval_status === 'pending')
                <div class="col-md-4">
                    <form method="POST" action="{{ route('admin.ecommerce.b2b.approve', $b2b) }}" onsubmit="return confirm('Approve this B2B customer application?');">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check me-2"></i>Approve Application
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i class="fas fa-times me-2"></i>Reject Application
                    </button>
                </div>
            @elseif($b2b->approval_status === 'approved')
                <div class="col-md-4">
                    <form method="POST" action="{{ route('admin.ecommerce.b2b.toggle-status', $b2b) }}" onsubmit="return confirm('{{ $b2b->is_active ? 'Deactivate' : 'Activate' }} this B2B customer?');">
                        @csrf
                        <button type="submit" class="btn {{ $b2b->is_active ? 'btn-warning' : 'btn-success' }} w-100">
                            <i class="fas {{ $b2b->is_active ? 'fa-pause' : 'fa-play' }} me-2"></i>
                            {{ $b2b->is_active ? 'Deactivate' : 'Activate' }} Account
                        </button>
                    </form>
                </div>
            @endif
            <div class="col-md-4">
                <a href="{{ route('admin.ecommerce.b2b.edit', $b2b) }}" class="btn btn-primary w-100">
                    <i class="fas fa-edit me-2"></i>Edit Details
                </a>
            </div>
            @if($b2b->orders()->count() === 0)
                <div class="col-md-4">
                    <form method="POST" action="{{ route('admin.ecommerce.b2b.destroy', $b2b) }}" onsubmit="return confirm('Delete this B2B customer? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Account
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Order History -->
<div class="glass-card">
    <div class="card-header bg-info border-secondary">
        <h5 class="mb-0 text-white">
            <i class="fas fa-shopping-bag me-2"></i>Recent Orders ({{ $b2b->orders->count() }})
        </h5>
    </div>
    <div class="card-body bg-dark">
        @if($b2b->orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th class="text-white">Order #</th>
                            <th class="text-white">Date</th>
                            <th class="text-white">Type</th>
                            <th class="text-white">Total</th>
                            <th class="text-white">Status</th>
                            <th class="text-white text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($b2b->orders as $order)
                            <tr>
                                <td><code class="text-warning">{{ $order->order_number }}</code></td>
                                <td><span class="text-white">{{ $order->created_at->format('M d, Y') }}</span></td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($order->order_type) }}</span>
                                </td>
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
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open text-muted fs-1 mb-3 d-block"></i>
                <p class="text-white">No orders yet / এখনও কোনো অর্ডার নেই</p>
                <small class="text-muted">Customer's order history will appear here</small>
            </div>
        @endif
    </div>
</div>

<!-- Reject Modal -->
@if($b2b->approval_status === 'pending')
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-white">Reject B2B Application</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.ecommerce.b2b.reject', $b2b) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-white">Rejection Reason <span class="text-danger">*</span></label>
                            <textarea name="rejection_reason" class="form-control bg-dark text-white border-secondary" rows="4" required placeholder="Please explain why this application is being rejected..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@endsection
