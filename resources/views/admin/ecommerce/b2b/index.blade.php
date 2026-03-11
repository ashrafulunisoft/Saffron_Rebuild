@extends('layouts.admin')

@section('title', 'B2B Management - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">B2B Management <span class="text-white">ব্যবসায়িক গ্রাহক ব্যবস্থাপনা</span></h2>
        <p class="text-white mb-0">Manage wholesale and business customers</p>
    </div>
    <div>
        <a href="{{ route('admin.ecommerce.b2b.create') }}" class="btn btn-gradient">
            <i class="fas fa-plus me-2"></i> Add B2B Customer
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-dark border-secondary report-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary rounded p-3">
                            <i class="fas fa-building text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Total B2B Customers</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $totalB2BCustomers }}</h4>
                        <small class="text-muted">Registered businesses</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border-secondary report-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning rounded p-3">
                            <i class="fas fa-clock text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Pending Approval</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $pendingApprovals }}</h4>
                        <small class="text-muted">Awaiting review</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border-secondary report-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success rounded p-3">
                            <i class="fas fa-check-circle text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Approved</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $approvedCustomers }}</h4>
                        <small class="text-muted">{{ $activeCustomers }} active</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border-secondary report-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-danger rounded p-3">
                            <i class="fas fa-times-circle text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Rejected</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $rejectedCustomers }}</h4>
                        <small class="text-muted">Declined applications</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Search -->
<div class="glass-card mb-4">
    <div class="card-body bg-dark">
        <form method="GET" action="{{ route('admin.ecommerce.b2b.index') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control bg-dark text-white border-secondary"
                       placeholder="Search by company name or email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select bg-dark text-white border-secondary">
                    <option value="all">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="business_type" class="form-select bg-dark text-white border-secondary">
                    <option value="all">All Business Types</option>
                    <option value="retailer" {{ request('business_type') == 'retailer' ? 'selected' : '' }}>Retailer</option>
                    <option value="wholesaler" {{ request('business_type') == 'wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                    <option value="distributor" {{ request('business_type') == 'distributor' ? 'selected' : '' }}>Distributor</option>
                    <option value="manufacturer" {{ request('business_type') == 'manufacturer' ? 'selected' : '' }}>Manufacturer</option>
                    <option value="reseller" {{ request('business_type') == 'reseller' ? 'selected' : '' }}>Reseller</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient flex-grow-1">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search') || request('status') || request('business_type'))
                        <a href="{{ route('admin.ecommerce.b2b.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- B2B Customers Table -->
<div class="glass-card">
    <div class="card-header bg-primary border-secondary">
        <h5 class="mb-0 text-white">
            <i class="fas fa-building me-2"></i>B2B Customers
            <span class="badge bg-light text-dark ms-2">{{ $b2bCustomers->total() }}</span>
        </h5>
    </div>
    <div class="card-body bg-dark">
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th class="text-white">Company</th>
                        <th class="text-white">Business Type</th>
                        <th class="text-white">Contact</th>
                        <th class="text-white">Credit Limit</th>
                        <th class="text-white">Discount</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Orders</th>
                        <th class="text-white text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($b2bCustomers as $b2b)
                        <tr>
                            <td>
                                <div class="fw-bold text-white">{{ $b2b->company_name }}</div>
                                <small class="text-info">{{ $b2b->user->email }}</small>
                                @if($b2b->trade_license_number)
                                    <br><small class="text-muted">License: {{ $b2b->trade_license_number }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary text-uppercase">{{ $b2b->business_type }}</span>
                            </td>
                            <td>
                                @if($b2b->contact_person)
                                    <div class="text-white">{{ $b2b->contact_person }}</div>
                                @endif
                                @if($b2b->contact_phone)
                                    <small class="text-info">{{ $b2b->contact_phone }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="text-white">৳{{ number_format($b2b->credit_limit, 2) }}</span>
                                @if($b2b->current_balance > 0)
                                    <br><small class="text-warning">Used: ৳{{ number_format($b2b->current_balance, 2) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $b2b->wholesale_discount }}%</span>
                                <br><small class="text-muted">{{ ucfirst($b2b->pricing_tier) }}</small>
                            </td>
                            <td>
                                @if($b2b->approval_status === 'pending')
                                    <span class="badge bg-warning">Pending / অপেক্ষারত</span>
                                @elseif($b2b->approval_status === 'approved')
                                    @if($b2b->is_active)
                                        <span class="badge bg-success">Active / সক্রিয়</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                @else
                                    <span class="badge bg-danger">Rejected / বাতিল</span>
                                @endif
                            </td>
                            <td><span class="badge bg-primary">{{ $b2b->orders_count }}</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.ecommerce.b2b.show', $b2b) }}"
                                       class="btn btn-sm btn-primary"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($b2b->approval_status === 'pending')
                                        <form method="POST"
                                              action="{{ route('admin.ecommerce.b2b.approve', $b2b) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Approve this B2B customer?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($b2b->is_active ?? false)
                                        <form method="POST"
                                              action="{{ route('admin.ecommerce.b2b.toggle-status', $b2b) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Deactivate this B2B customer?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning" title="Deactivate">
                                                <i class="fas fa-pause"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admin.ecommerce.b2b.toggle-status', $b2b) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Activate this B2B customer?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Activate">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-building fs-1 mb-3 d-block"></i>
                                    <p class="text-white">No B2B customers found / কোনো B2B গ্রাহক পাওয়া যায়নি</p>
                                    <small>Start by adding your first wholesale customer</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($b2bCustomers->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $b2bCustomers->firstItem() }} to {{ $b2bCustomers->lastItem() }} of {{ $b2bCustomers->total() }} customers
                </div>
                {{ $b2bCustomers->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
