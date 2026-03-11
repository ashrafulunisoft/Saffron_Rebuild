@extends('layouts.admin')

@section('title', 'Customer Management - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Customer Management <span class="text-white">গ্রাহক ব্যবস্থাপনা</span></h2>
        <p class="text-white mb-0">Manage your customers and view their order history</p>
    </div>
    <div>
        <form method="GET" action="{{ route('admin.ecommerce.customers.index') }}" class="d-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control bg-dark text-white border-secondary" placeholder="Search by name or email..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-gradient">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.ecommerce.customers.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
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
                            <i class="fas fa-users text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Total Customers</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $totalCustomers }}</h4>
                        <small class="text-muted">Registered users</small>
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
                            <i class="fas fa-user-check text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Active Customers</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $activeCustomers }}</h4>
                        <small class="text-muted">Verified accounts</small>
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
                            <i class="fas fa-user-clock text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">New This Month</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $newCustomersThisMonth }}</h4>
                        <small class="text-muted">New registrations</small>
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
                            <i class="fas fa-user-slash text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Banned</h6>
                        <h4 class="fw-bold text-white mb-0">{{ $bannedCustomers }}</h4>
                        <small class="text-muted">Banned accounts</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Buttons -->
<div class="glass-card mb-4">
    <div class="card-body bg-dark">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.ecommerce.customers.index') }}"
               class="btn {{ request('status') == null || request('status') == 'all' ? 'btn-primary' : 'btn-outline-secondary' }}">
                All Customers ({{ $totalCustomers }})
            </a>
            <a href="{{ route('admin.ecommerce.customers.index', ['status' => 'active']) }}"
               class="btn {{ request('status') == 'active' ? 'btn-success' : 'btn-outline-secondary' }}">
                <i class="fas fa-user-check me-2"></i>Active ({{ $activeCustomers }})
            </a>
            <a href="{{ route('admin.ecommerce.customers.index', ['status' => 'banned']) }}"
               class="btn {{ request('status') == 'banned' ? 'btn-danger' : 'btn-outline-secondary' }}">
                <i class="fas fa-ban me-2"></i>Banned ({{ $bannedCustomers }})
            </a>
        </div>
    </div>
</div>

<!-- Customers Table -->
<div class="glass-card">
    <div class="card-header bg-primary border-secondary">
        <h5 class="mb-0 text-white">
            <i class="fas fa-users me-2"></i>Customer List
            <span class="badge bg-light text-dark ms-2">{{ $customers->total() }}</span>
        </h5>
    </div>
    <div class="card-body bg-dark">
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th class="text-white">Customer</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Orders</th>
                        <th class="text-white">Reviews</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Joined</th>
                        <th class="text-white text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white">{{ $customer->name }}</div>
                                        @if($customer->phone)
                                            <small class="text-info">{{ $customer->phone }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-white">{{ $customer->email }}</span>
                                @if($customer->email_verified_at)
                                    <i class="fas fa-check-circle text-success ms-1" title="Verified"></i>
                                @else
                                    <i class="fas fa-exclamation-circle text-warning ms-1" title="Not Verified"></i>
                                @endif
                            </td>
                            <td><span class="badge bg-primary">{{ $customer->orders_count }}</span></td>
                            <td><span class="badge bg-info">{{ $customer->reviews_count }}</span></td>
                            <td>
                                @if($customer->banned ?? false)
                                    <span class="badge bg-danger">Banned / নিষিদ্ধ</span>
                                @elseif($customer->email_verified_at)
                                    <span class="badge bg-success">Active / সক্রিয়</span>
                                @else
                                    <span class="badge bg-warning">Pending / অপেক্ষারত</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-white">{{ $customer->created_at->format('M d, Y') }}</span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.ecommerce.customers.show', $customer) }}"
                                       class="btn btn-sm btn-primary"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($customer->banned ?? false)
                                        <form method="POST"
                                              action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Unban this customer?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Unban">
                                                <i class="fas fa-unlock"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Ban this customer? They will not be able to place orders.');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Ban">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-users-slash fs-1 mb-3 d-block"></i>
                                    <p class="text-white">No customers found / কোনো গ্রাহক পাওয়া যায়নি</p>
                                    <small>Customers will appear here once they register</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($customers->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} customers
                </div>
                {{ $customers->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
