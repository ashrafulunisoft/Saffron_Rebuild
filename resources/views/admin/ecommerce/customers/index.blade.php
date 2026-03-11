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
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Customers</h2>
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
        <div class="row g-3 mb-4" style="background: rgba(15, 23, 42, 0.6); padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
            <div class="col-md-6">
                <form method="GET" action="{{ route('admin.ecommerce.customers.index') }}" class="d-flex gap-2">
                    <div class="position-relative flex-grow-1">
                        <input type="text" name="search" class="input-dark input-custom" placeholder="Search customers..." value="{{ request('search') }}" style="color: white;">
                        <i class="fas fa-search input-icon"></i>
                    </div>
                    <button type="submit" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 12px;">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.ecommerce.customers.index') }}" class="btn-outline" style="padding: 0.75rem 1rem; border-radius: 12px; text-decoration: none;">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.ecommerce.customers.index') }}"
                       class="btn-badge {{ request('status') == null || request('status') == 'all' ? 'active' : '' }}"
                       style="padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); border: 1px solid rgba(59, 130, 246, 0.3);">
                        All ({{ $totalCustomers }})
                    </a>
                    <a href="{{ route('admin.ecommerce.customers.index', ['status' => 'active']) }}"
                       class="btn-badge {{ request('status') == 'active' ? 'active' : '' }}"
                       style="padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; background: rgba(34, 197, 94, 0.2); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.3);">
                        <i class="fas fa-user-check me-1"></i>Active ({{ $activeCustomers }})
                    </a>
                    <a href="{{ route('admin.ecommerce.customers.index', ['status' => 'banned']) }}"
                       class="btn-badge {{ request('status') == 'banned' ? 'active' : '' }}"
                       style="padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">
                        <i class="fas fa-ban me-1"></i>Banned ({{ $bannedCustomers }})
                    </a>
                </div>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Customer</th>
                        <th>Email</th>
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
                        <td colspan="8" class="text-center py-5">
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
    .btn-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .btn-badge.active {
        box-shadow: 0 0 20px currentColor;
    }
</style>
@endpush
@endsection
