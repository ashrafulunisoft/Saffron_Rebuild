@extends('layouts.admin')

@section('title', 'B2B Management - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">B2B / WHOLESALE</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">B2B Customers</h2>
                <a href="{{ route('admin.ecommerce.b2b.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-plus me-2"></i>Add New
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total B2B</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalB2BCustomers }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-building" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Pending</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $pendingApprovals }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-clock" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Approved</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $approvedCustomers }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(34, 197, 94, 0.2);">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Active</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $activeCustomers }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2);">
                            <i class="fas fa-bolt" style="color: #a855f7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row g-3 mb-4" style="background: rgba(15, 23, 42, 0.6); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
            <form method="GET" action="{{ route('admin.ecommerce.b2b.index') }}" class="row g-3">
                <div class="col-md-4">
                    <div class="position-relative">
                        <input type="text" name="search" class="input-dark input-custom" placeholder="Search company or email..." value="{{ request('search') }}">

                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="input-dark input-custom">
                        <option value="all">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="business_type" class="input-dark input-custom">
                        <option value="all">All Types</option>
                        <option value="retailer" {{ request('business_type') == 'retailer' ? 'selected' : '' }}>Retailer</option>
                        <option value="wholesaler" {{ request('business_type') == 'wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                        <option value="distributor" {{ request('business_type') == 'distributor' ? 'selected' : '' }}>Distributor</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn-gradient flex-grow-1" style="border-radius: 12px;">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search') || request('status') || request('business_type'))
                        <a href="{{ route('admin.ecommerce.b2b.index') }}" class="btn-outline d-flex align-items-center justify-content-center" style="border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; width: 48px;">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- B2B Table -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company</th>
                        <th>Business Type</th>
                        <th>Contact</th>
                        <th>Credit Limit</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Orders</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($b2bCustomers as $index => $b2b)
                    <tr>
                        <td>{{ ($b2bCustomers->currentPage() - 1) * $b2bCustomers->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-circle" style="background: linear-gradient(135deg, #3b82f6, #8b5cf6);">
                                    {{ substr($b2b->company_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $b2b->company_name }}</div>
                                    <div style="font-size: 0.75rem; opacity: 0.6;">{{ $b2b->user->email }}</div>
                                    @if($b2b->trade_license_number)
                                        <div style="font-size: 0.7rem; opacity: 0.4;">{{ $b2b->trade_license_number }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-visit-type">{{ ucfirst($b2b->business_type) }}</span>
                        </td>
                        <td>
                            @if($b2b->contact_person)
                                <div style="font-size: 0.85rem;">{{ $b2b->contact_person }}</div>
                            @endif
                            @if($b2b->contact_phone)
                                <div style="font-size: 0.75rem; opacity: 0.6;"><i class="fas fa-phone me-1"></i>{{ $b2b->contact_phone }}</div>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 0.9rem;">৳{{ number_format($b2b->credit_limit, 0) }}</div>
                            @if($b2b->current_balance > 0)
                                <div style="font-size: 0.7rem; opacity: 0.6;">Used: ৳{{ number_format($b2b->current_balance, 0) }}</div>
                            @endif
                        </td>
                        <td>
                            <div class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e;">{{ $b2b->wholesale_discount }}%</div>
                            <div style="font-size: 0.7rem; opacity: 0.6; margin-top: 4px;">{{ ucfirst($b2b->pricing_tier) }}</div>
                        </td>
                        <td>
                            @if($b2b->approval_status === 'pending')
                                <span class="badge badge-pending">
                                    <i class="fas fa-clock me-1"></i> Pending
                                </span>
                            @elseif($b2b->approval_status === 'approved')
                                @if($b2b->is_active)
                                    <span class="badge badge-approved">
                                        <i class="fas fa-check-circle me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge" style="background: rgba(107, 114, 128, 0.2); color: #94a3b8;">Inactive</span>
                                @endif
                            @else
                                <span class="badge badge-cancelled">
                                    <i class="fas fa-times-circle me-1"></i> Rejected
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="badge" style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue);">{{ $b2b->orders_count }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.b2b.show', $b2b) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($b2b->approval_status === 'pending')
                                    <form method="POST" action="{{ route('admin.ecommerce.b2b.approve', $b2b) }}" class="d-inline" onsubmit="return confirm('Approve this B2B customer?');">
                                        @csrf
                                        <button type="submit" class="action-btn btn-approve" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.ecommerce.b2b.edit', $b2b) }}" class="action-btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <i class="fas fa-building" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No B2B customers found</div>
                            <a href="{{ route('admin.ecommerce.b2b.create') }}" class="btn-gradient" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                                <i class="fas fa-plus me-2"></i>Add B2B Customer
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($b2bCustomers->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                Showing {{ ($b2bCustomers->currentPage() - 1) * $b2bCustomers->perPage() + 1 }}
                to {{ min($b2bCustomers->currentPage() * $b2bCustomers->perPage(), $b2bCustomers->total()) }}
                of {{ $b2bCustomers->total() }} entries
            </div>
            {{ $b2bCustomers->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<style>
    .stat-card {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 1.5rem;
        transition: 0.3s;
    }

    .stat-card:hover {
        border-color: rgba(59, 130, 246, 0.3);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead th {
        background: rgba(15, 23, 42, 0.8);
        color: #fff;
        padding: 1rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-align: left;
        border-bottom: 2px solid rgba(59, 130, 246, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom tbody tr {
        background: rgba(15, 23, 42, 0.3);
        transition: 0.2s;
        border-bottom: 1px solid rgba(255,255,255,0.03);
    }

    .table-custom tbody tr:hover {
        background: rgba(59, 130, 246, 0.1);
    }

    .table-custom td {
        padding: 1rem;
        color: rgba(255, 255, 255, 0.8);
        vertical-align: middle;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #fff;
    }

    .badge {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .badge-visit-type {
        background: rgba(59, 130, 246, 0.2);
        color: var(--accent-blue);
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .badge-approved {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .badge-pending {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .badge-completed {
        background: rgba(168, 85, 247, 0.2);
        color: #a855f7;
        border: 1px solid rgba(168, 85, 247, 0.3);
    }

    .badge-cancelled {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        font-size: 0.85rem;
        text-decoration: none;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.2);
        color: var(--accent-blue);
    }

    .btn-view:hover {
        background: var(--accent-blue);
        color: #fff;
    }

    .btn-edit {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
    }

    .btn-edit:hover {
        background: #fbbf24;
        color: #000;
    }

    .btn-approve {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .btn-approve:hover {
        background: #22c55e;
        color: #fff;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: #fff;
    }

    .pagination {
        margin: 0;
    }

    .page-link {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 8px;
        transition: 0.2s;
    }

    .page-link:hover {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
    }

    .page-item.active .page-link {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
    }

    .input-dark {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        transition: 0.3s;
        width: 100%;
    }

    .input-dark:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    .input-custom {
        font-size: 0.9rem;
    }

    

    select.input-dark {
        padding-left: 1rem;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='rgba(255,255,255,0.5)'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 2.75rem;
    }

    .btn-gradient {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        color: #fff;
        border: none;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: 0.3s;
    }

    .btn-outline:hover {
        border-color: var(--accent-blue);
        background: rgba(59, 130, 246, 0.1);
    }
</style>
@endpush
@endsection
