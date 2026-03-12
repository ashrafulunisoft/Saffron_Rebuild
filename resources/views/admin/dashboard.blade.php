@extends('layouts.admin')

@section('title', 'Admin Dashboard - Saffron E-Commerce')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Unified Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem;">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title">ADMIN DASHBOARD</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <p class="small fw-800 mb-0 text-white">{{ Auth::user()->name }}</p>
                    <span class="text-muted fs-9">Administrator</span>
                </div>
                <div class="avatar-circle" style="background: linear-gradient(135deg, var(--accent-blue), #8b5cf6); width: 44px; height: 44px;">
                    <i class="fas fa-user-tie text-white small"></i>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.ecommerce.products.index') }}" class="text-decoration-none">
                    <div class="quick-access-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="quick-icon" style="background: rgba(59, 130, 246, 0.2);">
                                <i class="fas fa-box" style="color: var(--accent-blue); font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0 fw-800">{{ $ecommerceStats['total_products'] ?? 0 }}</h6>
                                <span class="text-muted fs-9">Products</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.ecommerce.orders.index') }}" class="text-decoration-none">
                    <div class="quick-access-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="quick-icon" style="background: rgba(34, 197, 94, 0.2);">
                                <i class="fas fa-shopping-bag" style="color: #22c55e; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0 fw-800">{{ $ecommerceStats['total_orders'] ?? 0 }}</h6>
                                <span class="text-muted fs-9">Orders</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.ecommerce.customers.index') }}" class="text-decoration-none">
                    <div class="quick-access-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="quick-icon" style="background: rgba(168, 85, 247, 0.2);">
                                <i class="fas fa-users" style="color: #a855f7; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0 fw-800">{{ $ecommerceStats['total_customers'] ?? 0 }}</h6>
                                <span class="text-muted fs-9">Customers</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('admin.ecommerce.reports.index') }}" class="text-decoration-none">
                    <div class="quick-access-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="quick-icon" style="background: rgba(251, 191, 36, 0.2);">
                                <i class="fas fa-chart-bar" style="color: #fbbf24; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0 fw-800">Reports</h6>
                                <span class="text-muted fs-9">Analytics</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="row g-4 mb-5">
            <!-- Ecommerce Statistics -->
            <div class="col-12">
                <div style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-800 mb-0 text-white">
                            <i class="fas fa-store me-2" style="color: var(--accent-blue);"></i>E-Commerce Overview
                        </h6>
                        <a href="{{ route('admin.ecommerce.reports.index') }}" class="btn btn-sm btn-outline">
                            <i class="fas fa-chart-line me-1"></i> View Reports
                        </a>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-3 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Today's Revenue</h6>
                                        <h3 class="text-white fw-800 mb-0">৳{{ number_format($ecommerceStats['today_revenue'] ?? 0, 0) }}</h3>
                                    </div>
                                    <div class="stat-icon" style="background: rgba(34, 197, 94, 0.2);">
                                        <i class="fas fa-taka-sign" style="color: #22c55e;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Pending Orders</h6>
                                        <h3 class="text-white fw-800 mb-0">{{ $ecommerceStats['pending_orders'] ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                                        <i class="fas fa-clock" style="color: #fbbf24;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Low Stock Items</h6>
                                        <h3 class="text-white fw-800 mb-0">{{ $lowStockProducts->count() ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon" style="background: rgba(239, 68, 68, 0.2);">
                                        <i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Pending Reviews</h6>
                                        <h3 class="text-white fw-800 mb-0">{{ $ecommerceStats['pending_reviews'] ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2);">
                                        <i class="fas fa-star" style="color: #a855f7;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tables Row - All 3 in Same Row -->
        <div class="row g-4">
            <!-- Recent Orders -->
            <div class="col-lg-4">
                <div class="data-card" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 1.5rem; height: 100%; transition: all 0.3s ease;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-800 mb-0 text-white" style="font-size: 0.95rem;">
                            <i class="fas fa-shopping-cart me-2" style="color: var(--accent-blue);"></i>Recent Orders
                        </h6>
                        <a href="{{ route('admin.ecommerce.orders.index') }}" class="btn btn-sm btn-outline">
                            <i class="fas fa-arrow-right small"></i>
                        </a>
                    </div>
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table-custom mb-0" style="font-size: 0.85rem;">
                                <thead>
                                    <tr>
                                        <th style="padding: 0.75rem 0.5rem;">Order</th>
                                        <th style="padding: 0.75rem 0.5rem;">Amount</th>
                                        <th style="padding: 0.75rem 0.5rem;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <div class="fw-bold small">#{{ $order->order_number ?? $order->id }}</div>
                                            <div style="font-size: 0.75rem; opacity: 0.6;">{{ $order->user->name ?? 'N/A' }}</div>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span class="fw-800 text-white small">৳{{ number_format($order->final_amount ?? $order->total_amount ?? 0, 0) }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            @if($order->status == 'completed')
                                                <span class="badge badge-completed" style="font-size: 0.65rem; padding: 0.3rem 0.6rem;">Completed</span>
                                            @elseif($order->status == 'pending')
                                                <span class="badge badge-pending" style="font-size: 0.65rem; padding: 0.3rem 0.6rem;">Pending</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge badge-cancelled" style="font-size: 0.65rem; padding: 0.3rem 0.6rem;">Cancelled</span>
                                            @else
                                                <span class="badge badge-visit-type" style="font-size: 0.65rem; padding: 0.3rem 0.6rem;">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart" style="font-size: 36px; opacity: 0.2; margin-bottom: 0.75rem;"></i>
                            <div class="text-muted small">No orders yet</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Low Stock Products -->
            <div class="col-lg-4">
                <div class="data-card" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 1.5rem; height: 100%; transition: all 0.3s ease;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-800 mb-0 text-white" style="font-size: 0.95rem;">
                            <i class="fas fa-exclamation-circle me-2" style="color: #ef4444;"></i>Low Stock
                        </h6>
                        <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-sm btn-outline" style="border-color: rgba(239, 68, 68, 0.3); color: #ef4444;">
                            <i class="fas fa-arrow-right small"></i>
                        </a>
                    </div>
                    @if($lowStockProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="table-custom mb-0" style="font-size: 0.85rem;">
                                <thead>
                                    <tr>
                                        <th style="padding: 0.75rem 0.5rem;">Product</th>
                                        <th style="padding: 0.75rem 0.5rem;">Stock</th>
                                        <th style="padding: 0.75rem 0.5rem;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowStockProducts as $product)
                                    <tr>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span class="small fw-bold">{{ \Illuminate\Support\Str::limit($product->name_en ?? 'N/A', 20) }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span class="fw-800" style="color: #ef4444;">{{ $product->stock }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            @if($product->stock == 0)
                                                <span class="badge badge-cancelled" style="font-size: 0.65rem; padding: 0.3rem 0.6rem;">Out</span>
                                            @else
                                                <span class="badge badge-pending" style="font-size: 0.65rem; padding: 0.3rem 0.6rem;">Low</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle" style="font-size: 36px; opacity: 0.2; color: #22c55e; margin-bottom: 0.75rem;"></i>
                            <div class="text-muted small">All in stock!</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Top Selling Products -->
            <div class="col-lg-4">
                <div class="data-card" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 1.5rem; height: 100%; transition: all 0.3s ease;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-800 mb-0 text-white" style="font-size: 0.95rem;">
                            <i class="fas fa-trophy me-2" style="color: #fbbf24;"></i>Top Products
                        </h6>
                        <a href="{{ route('admin.ecommerce.reports.index') }}" class="btn btn-sm btn-outline" style="border-color: rgba(251, 191, 36, 0.3); color: #fbbf24;">
                            <i class="fas fa-arrow-right small"></i>
                        </a>
                    </div>
                    @if($topProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="table-custom mb-0" style="font-size: 0.85rem;">
                                <thead>
                                    <tr>
                                        <th style="padding: 0.75rem 0.5rem;">#</th>
                                        <th style="padding: 0.75rem 0.5rem;">Product</th>
                                        <th style="padding: 0.75rem 0.5rem;">Sold</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topProducts as $index => $product)
                                    <tr>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            @if($index == 0)
                                                <span class="badge" style="background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #000; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem;">🥇</span>
                                            @elseif($index == 1)
                                                <span class="badge" style="background: linear-gradient(135deg, #94a3b8, #64748b); color: #000; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem;">🥈</span>
                                            @elseif($index == 2)
                                                <span class="badge" style="background: linear-gradient(135deg, #b45309, #92400e); color: #fff; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem;">🥉</span>
                                            @else
                                                <span class="badge badge-visit-type" style="font-size: 0.7rem;">{{ $index + 1 }}</span>
                                            @endif
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span class="small fw-bold">{{ \Illuminate\Support\Str::limit($product->name_en ?? 'N/A', 18) }}</span>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <span class="fw-800 text-white">{{ $product->order_items_count ?? 0 }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-box-open" style="font-size: 36px; opacity: 0.2; margin-bottom: 0.75rem;"></i>
                            <div class="text-muted small">No sales data</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
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

/* Quick Access Cards */
.quick-access-card {
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 1.25rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.6s ease-out;
    position: relative;
    overflow: hidden;
}

.quick-access-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
    opacity: 0;
    transition: opacity 0.4s ease;
    border-radius: 16px;
}

.quick-access-card:hover {
    transform: translateY(-8px) scale(1.02);
    border-color: rgba(59, 130, 246, 0.4);
    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.2),
                0 0 20px rgba(59, 130, 246, 0.1);
}

.quick-access-card:hover::before {
    opacity: 1;
}

/* Stagger animation delays */
.quick-access-card:nth-child(1) { animation-delay: 0.1s; }
.quick-access-card:nth-child(2) { animation-delay: 0.2s; }
.quick-access-card:nth-child(3) { animation-delay: 0.3s; }
.quick-access-card:nth-child(4) { animation-delay: 0.4s; }

.quick-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.quick-access-card:hover .quick-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

/* Avatar Circle */
.avatar-circle {
    background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    transition: all 0.3s ease;
}

.avatar-circle:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
}

/* Enhanced Button Glow Effects */
.btn-outline {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-outline::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
}

.btn-outline:hover::before {
    width: 300px;
    height: 300px;
}

.btn-outline:hover {
    border-color: var(--accent-blue);
    background: rgba(59, 130, 246, 0.15);
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.4),
                0 0 40px rgba(59, 130, 246, 0.2),
                inset 0 0 20px rgba(59, 130, 246, 0.1);
    transform: translateY(-2px);
    text-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
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

/* Stat Icon Glow */
.stat-icon {
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    transform: scale(1.15);
    box-shadow: 0 8px 25px currentColor;
}

/* Table Row Fade */
.table-custom tbody tr {
    transition: all 0.3s ease;
    animation: fadeInUp 0.5s ease-out;
}

.table-custom tbody tr:nth-child(1) { animation-delay: 0.1s; }
.table-custom tbody tr:nth-child(2) { animation-delay: 0.15s; }
.table-custom tbody tr:nth-child(3) { animation-delay: 0.2s; }
.table-custom tbody tr:nth-child(4) { animation-delay: 0.25s; }
.table-custom tbody tr:nth-child(5) { animation-delay: 0.3s; }

/* Data Card Hover Effects */
.data-card {
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease-out;
}

.data-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
    border-radius: 16px;
}

.data-card:hover {
    transform: translateY(-5px);
    border-color: rgba(59, 130, 246, 0.2);
    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.15),
                0 0 20px rgba(59, 130, 246, 0.1);
}

.data-card:hover::before {
    opacity: 1;
}

/* Stagger data card animations */
.data-card:nth-child(1) { animation-delay: 0.5s; }
.data-card:nth-child(2) { animation-delay: 0.6s; }
.data-card:nth-child(3) { animation-delay: 0.7s; }

/* Badge Glow */
.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px currentColor;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .col-lg-4 {
        margin-bottom: 1.5rem;
    }

    .data-card {
        animation-delay: 0.3s !important;
    }
}

@media (max-width: 768px) {
    .quick-access-card {
        padding: 1rem;
    }

    .quick-icon {
        width: 40px;
        height: 40px;
    }

    .quick-icon i {
        font-size: 1.2rem !important;
    }

    /* Stack tables on mobile */
    .col-lg-4 {
        width: 100%;
    }

    .table-custom thead th,
    .table-custom tbody td {
        padding: 0.6rem 0.4rem !important;
        font-size: 0.75rem !important;
    }

    .data-card:hover {
        transform: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Auto-refresh dashboard data every 30 seconds
setInterval(function() {
    // Optional: Add AJAX refresh logic here
    console.log('Dashboard auto-refresh');
}, 30000);
</script>
@endpush
@endsection
