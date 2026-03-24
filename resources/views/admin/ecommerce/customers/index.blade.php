@extends('layouts.admin')

@section('title', 'Customers - Saffron Admin')

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
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Customers</h2>
                <a href="{{ route('admin.ecommerce.customers.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                    <i class="fas fa-plus me-2"></i>Add Customer
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Customers</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $totalCustomers }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-users" style="color: var(--accent-blue);"></i>
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
                        <div class="stat-icon" style="background: rgba(34, 197, 94, 0.2);">
                            <i class="fas fa-user-check" style="color: #22c55e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">New This Month</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $newCustomersThisMonth }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-user-clock" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Banned</h6>
                            <h3 class="text-white fw-800 mb-0">{{ $bannedCustomers }}</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.2);">
                            <i class="fas fa-user-slash" style="color: #ef4444;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <form method="GET" action="{{ route('admin.ecommerce.customers.index') }}">
        <div class="filter-section row g-3 mb-4" style="background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(20px); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08); transition: all 0.3s ease; position: relative; overflow: hidden;">
            <div class="col-md-4">
                <div class="d-flex gap-2">
                    <div class="position-relative flex-grow-1">
                        <input type="text" name="search" class="input-dark input-custom" placeholder="Search customers..." value="{{ request('search') }}" style="color: white;">
                    </div>
                    <button type="submit" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 12px;">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search') || request('role'))
                        <a href="{{ route('admin.ecommerce.customers.index') }}" class="btn-outline" style="padding: 0.75rem 1rem; border-radius: 12px; text-decoration: none;">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <select name="role" class="input-dark input-custom" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-2">
                    <button type="submit" name="status" value=""
                            class="btn-badge {{ request('status') == null || request('status') == '' ? 'active' : '' }}"
                            style="padding: 0.75rem 1.5rem; border-radius: 12px; border: none; cursor: pointer; background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); border: 1px solid rgba(59, 130, 246, 0.3);">
                        All
                    </button>
                    <button type="submit" name="status" value="active"
                            class="btn-badge {{ request('status') == 'active' ? 'active' : '' }}"
                            style="padding: 0.75rem 1.5rem; border-radius: 12px; border: none; cursor: pointer; background: rgba(34, 197, 94, 0.2); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.3);">
                        <i class="fas fa-user-check me-1"></i>Active
                    </button>
                    <button type="submit" name="status" value="banned"
                            class="btn-badge {{ request('status') == 'banned' ? 'active' : '' }}"
                            style="padding: 0.75rem 1.5rem; border-radius: 12px; border: none; cursor: pointer; background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">
                        <i class="fas fa-ban me-1"></i>Banned
                    </button>
                </div>
            </div>
        </div>
        </form>

        <!-- Customers Table -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Orders</th>
                        <th>Reviews</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $index => $customer)
                    <tr>
                        <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle" style="background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-white fw-600" style="font-size: 0.9rem;">{{ $customer->name }}</div>
                                    @if($customer->phone)
                                        <div style="font-size: 0.75rem; opacity: 0.6;">{{ $customer->phone }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem;">{{ $customer->email }}</div>
                            @if($customer->email_verified_at)
                                <i class="fas fa-check-circle" style="color: #22c55e; font-size: 0.7rem;" title="Verified"></i>
                            @else
                                <i class="fas fa-exclamation-circle" style="color: #fbbf24; font-size: 0.7rem;" title="Not Verified"></i>
                            @endif
                        </td>
                        <td>
                            @if($customer->roles && $customer->roles->count() > 0)
                                @foreach($customer->roles as $role)
                                    <span class="badge" style="
                                        @if($role->name === 'admin')
                                            background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);
                                        @elseif($role->name === 'customer')
                                            background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); border: 1px solid rgba(59, 130, 246, 0.3);
                                        @elseif($role->name === 'b2b')
                                            background: rgba(168, 85, 247, 0.2); color: #a855f7; border: 1px solid rgba(168, 85, 247, 0.3);
                                        @else
                                            background: rgba(251, 191, 36, 0.2); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3);
                                        @endif
                                        padding: 0.3rem 0.6rem; font-size: 0.7rem; text-transform: capitalize; border-radius: 8px;
                                    ">
                                        <i class="
                                            @if($role->name === 'admin') fas fa-crown
                                            @elseif($role->name === 'customer') fas fa-user
                                            @elseif($role->name === 'b2b') fas fa-building
                                            @else fas fa-tag
                                        @endif
                                         me-1"></i>{{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="badge badge-pending" style="font-size: 0.7rem;">No Role</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-visit-type">{{ $customer->orders_count }}</span>
                        </td>
                        <td>
                            <span class="badge badge-completed">{{ $customer->reviews_count }}</span>
                        </td>
                        <td>
                            @if($customer->banned ?? false)
                                <span class="badge badge-cancelled">Banned</span>
                            @elseif($customer->email_verified_at)
                                <span class="badge badge-approved">Active</span>
                            @else
                                <span class="badge badge-pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 0.85rem;">{{ $customer->created_at->format('M d, Y') }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.ecommerce.customers.show', $customer) }}" class="action-btn btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($customer->banned ?? false)
                                    <form method="POST"
                                          action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}"
                                          class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Unban this customer?');"
                                                class="action-btn btn-approve"
                                                title="Unban">
                                            <i class="fas fa-unlock"></i>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST"
                                          action="{{ route('admin.ecommerce.customers.toggle-ban', $customer) }}"
                                          class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Ban this customer?');"
                                                class="action-btn btn-delete"
                                                title="Ban">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <i class="fas fa-users-slash" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No customers found</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($customers->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="text-white" style="font-size: 0.85rem; opacity: 0.7;">
                Showing {{ ($customers->currentPage() - 1) * $customers->perPage() + 1 }}
                to {{ min($customers->currentPage() * $customers->perPage(), $customers->total()) }}
                of {{ $customers->total() }} customers
            </div>
            {{ $customers->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    /* Fade In Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .btn-badge.active {
        box-shadow: 0 0 20px currentColor;
    }

    /* Enhanced Button Glow Effects */
    .btn-gradient {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-gradient:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4),
                    0 0 40px rgba(59, 130, 246, 0.2),
                    inset 0 0 20px rgba(255, 255, 255, 0.1);
    }

    /* Table Row Animations */
    .table-custom tbody tr {
        animation: fadeInUp 0.5s ease-out;
        transition: all 0.3s ease;
    }

    .table-custom tbody tr:nth-child(1) { animation-delay: 0.05s; }
    .table-custom tbody tr:nth-child(2) { animation-delay: 0.1s; }
    .table-custom tbody tr:nth-child(3) { animation-delay: 0.15s; }
    .table-custom tbody tr:nth-child(4) { animation-delay: 0.2s; }
    .table-custom tbody tr:nth-child(5) { animation-delay: 0.25s; }
    .table-custom tbody tr:nth-child(n+6) { animation-delay: 0.3s; }

    .table-custom tbody tr:hover {
        background: rgba(59, 130, 246, 0.15) !important;
        transform: scale(1.01);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.2);
    }

    /* Action Button Glow */
    .action-btn {
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: scale(1.15);
        box-shadow: 0 4px 15px currentColor;
    }

    /* Stat Card Enhancements */
    .stat-card {
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            45deg,
            transparent,
            rgba(59, 130, 246, 0.05),
            transparent
        );
        transform: rotate(45deg);
        transition: all 0.6s ease;
        opacity: 0;
    }

    .stat-card:hover::after {
        opacity: 1;
        animation: shine 1s ease;
    }

    @keyframes shine {
        0% {
            top: -50%;
            right: -50%;
        }
        100% {
            top: 150%;
            right: 150%;
        }
    }

    .stat-icon {
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.15);
        box-shadow: 0 8px 25px currentColor;
    }

    /* Filter Section Hover */
    .filter-section:hover {
        border-color: rgba(59, 130, 246, 0.3);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.15),
                    0 0 20px rgba(59, 130, 246, 0.1);
    }

    .input-dark {
        transition: all 0.3s ease;
    }

    .input-dark:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3),
                    0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    /* Badge Glow */
    .badge {
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 15px currentColor;
    }
</style>
@endpush
@endsection
