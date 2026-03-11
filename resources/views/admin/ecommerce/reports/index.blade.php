@extends('layouts.admin')

@section('title', 'Reports & Analytics - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">REPORTS & ANALYTICS</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Dashboard</h2>
        </div>

        <!-- Dashboard Summary -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Today's Revenue</h6>
                            <h3 class="text-white fw-800 mb-0">৳<span id="todayRevenue">0</span></h3>
                            <div style="font-size: 0.75rem; opacity: 0.6;">Yesterday: ৳<span id="yesterdayRevenue">0</span></div>
                        </div>
                        <div class="stat-icon" style="background: rgba(34, 197, 94, 0.2);">
                            <i class="fas fa-dollar-sign" style="color: #22c55e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Today's Orders</h6>
                            <h3 class="text-white fw-800 mb-0" id="todayOrders">0</h3>
                            <div style="font-size: 0.75rem; opacity: 0.6;">Pending: <span id="pendingOrders">0</span></div>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.2);">
                            <i class="fas fa-shopping-cart" style="color: var(--accent-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Low Stock</h6>
                            <h3 class="text-white fw-800 mb-0" id="lowStock">0</h3>
                            <div style="font-size: 0.75rem; opacity: 0.6;">Out of Stock: <span id="outOfStock">0</span></div>
                        </div>
                        <div class="stat-icon" style="background: rgba(251, 191, 36, 0.2);">
                            <i class="fas fa-exclamation-triangle" style="color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Growth Rate</h6>
                            <h3 class="text-white fw-800 mb-0" id="growthRate">0%</h3>
                            <div style="font-size: 0.75rem; opacity: 0.6;">vs last month</div>
                        </div>
                        <div class="stat-icon" style="background: rgba(168, 85, 247, 0.2);">
                            <i class="fas fa-chart-line" style="color: #a855f7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Tabs -->
        <div class="mb-4">
            <ul class="nav" style="border-bottom: 2px solid rgba(59, 130, 246, 0.3);">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" style="color: #fff; padding: 0.75rem 1.5rem; border-bottom: 3px solid var(--accent-blue); background: transparent;">
                        <i class="fas fa-chart-bar me-2"></i>Sales Reports
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" style="color: rgba(255,255,255,0.6); padding: 0.75rem 1.5rem; border-bottom: 3px solid transparent; background: transparent;">
                        <i class="fas fa-boxes me-2"></i>Inventory Reports
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab" style="color: rgba(255,255,255,0.6); padding: 0.75rem 1.5rem; border-bottom: 3px solid transparent; background: transparent;">
                        <i class="fas fa-star me-2"></i>Popular Products
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="revenue-tab" data-bs-toggle="tab" data-bs-target="#revenue" type="button" role="tab" style="color: rgba(255,255,255,0.6); padding: 0.75rem 1.5rem; border-bottom: 3px solid transparent; background: transparent;">
                        <i class="fas fa-chart-line me-2"></i>Revenue Charts
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="reportTabContent">

            <!-- Sales Reports -->
            <div class="tab-pane fade show active" id="sales" role="tabpanel">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                            <h6 class="text-white fw-700 mb-4">Revenue Chart</h6>
                            <div style="height: 300px;">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                            <h6 class="text-white fw-700 mb-4">Sales by Status</h6>
                            <div style="height: 300px;">
                                <canvas id="statusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 0;">
                    <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <h6 class="text-white fw-700 mb-0"><i class="fas fa-trophy me-2" style="color: #fbbf24;"></i>Top Selling Products</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table-custom" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Units Sold</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody id="topProductsBody">
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="spinner-border" role="status" style="color: var(--accent-blue);">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inventory Reports -->
            <div class="tab-pane fade" id="inventory" role="tabpanel">
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Total Products</h6>
                                <h3 class="text-white fw-800 mb-0" id="totalProducts">0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Active Products</h6>
                                <h3 class="text-white fw-800 mb-0" id="activeProducts">0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Low Stock (≤10)</h6>
                                <h3 class="text-white fw-800 mb-0" id="lowStockProducts">0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div>
                                <h6 class="text-white mb-2" style="font-size: 0.85rem; opacity: 0.7;">Out of Stock</h6>
                                <h3 class="text-white fw-800 mb-0" id="outOfStockProducts">0</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                            <h6 class="text-white fw-700 mb-4">Products by Category</h6>
                            <div style="height: 300px;">
                                <canvas id="categoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                            <h6 class="text-white fw-700 mb-4">Inventory Value</h6>
                            <div class="text-center" style="padding: 3rem 0;">
                                <h2 class="text-success fw-800 mb-2" style="font-size: 3rem;">৳<span id="inventoryValue">0</span></h2>
                                <p class="text-white" style="opacity: 0.6;">Total Inventory Value</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 0;">
                    <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <h6 class="text-white fw-700 mb-0"><i class="fas fa-exclamation-triangle me-2" style="color: #fbbf24;"></i>Low Stock Alert</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table-custom" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Current Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="lowStockTableBody">
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="spinner-border" role="status" style="color: var(--accent-blue);">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Popular Products -->
            <div class="tab-pane fade" id="products" role="tabpanel">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 0;">
                            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <h6 class="text-white fw-700 mb-0">Most Sold</h6>
                            </div>
                            <div style="padding: 1.5rem; max-height: 400px; overflow-y: auto;">
                                <div id="mostSoldList"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 0;">
                            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <h6 class="text-white fw-700 mb-0">Most Viewed</h6>
                            </div>
                            <div style="padding: 1.5rem; max-height: 400px; overflow-y: auto;">
                                <div id="mostViewedList"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 0;">
                            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <h6 class="text-white fw-700 mb-0">Top Rated</h6>
                            </div>
                            <div style="padding: 1.5rem; max-height: 400px; overflow-y: auto;">
                                <div id="topRatedList"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Charts -->
            <div class="tab-pane fade" id="revenue" role="tabpanel">
                <div class="row g-4 mb-4">
                    <div class="col-md-8">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="text-white fw-700 mb-0">Revenue Trend</h6>
                                <div class="d-flex gap-2">
                                    <button class="period-btn active" onclick="loadRevenueData('daily')" style="padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid var(--accent-blue); background: var(--accent-blue); color: #fff; font-size: 0.8rem;">7 Days</button>
                                    <button class="period-btn" onclick="loadRevenueData('weekly')" style="padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: transparent; color: #fff; font-size: 0.8rem;">4 Weeks</button>
                                    <button class="period-btn" onclick="loadRevenueData('monthly')" style="padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: transparent; color: #fff; font-size: 0.8rem;">12 Months</button>
                                    <button class="period-btn" onclick="loadRevenueData('yearly')" style="padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: transparent; color: #fff; font-size: 0.8rem;">5 Years</button>
                                </div>
                            </div>
                            <div style="height: 350px;">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                            <h6 class="text-white fw-700 mb-4">Forecast</h6>
                            <div class="text-center mb-4">
                                <h6 class="text-white mb-2" style="opacity: 0.6; font-size: 0.85rem;">Last Month Revenue</h6>
                                <h3 class="text-success fw-800 mb-0">৳<span id="lastMonthRevenue">0</span></h3>
                            </div>
                            <div class="text-center mb-4">
                                <h6 class="text-white mb-2" style="opacity: 0.6; font-size: 0.85rem;">Next Month Forecast</h6>
                                <h3 class="fw-800 mb-0" style="color: var(--accent-blue);">৳<span id="forecastRevenue">0</span></h3>
                            </div>
                            <div class="text-center">
                                <h6 class="text-white mb-2" style="opacity: 0.6; font-size: 0.85rem;">Growth Rate</h6>
                                <h3 class="text-white fw-800 mb-0" id="revenueGrowthRate">0%</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
                    <h6 class="text-white fw-700 mb-4">Revenue by Category</h6>
                    <div style="height: 300px;">
                        <canvas id="revenueByCategoryChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    .nav-link {
        transition: all 0.3s;
    }

    .nav-link:hover {
        color: #fff !important;
        border-bottom-color: rgba(59, 130, 246, 0.5) !important;
    }

    .nav-link.active {
        color: #fff !important;
        border-bottom-color: var(--accent-blue) !important;
    }

    .period-btn:hover {
        background: var(--accent-blue) !important;
        border-color: var(--accent-blue) !important;
    }

    .period-btn.active {
        background: var(--accent-blue) !important;
        border-color: var(--accent-blue) !important;
    }

    .product-rank-item {
        background: rgba(15, 23, 42, 0.4);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s;
    }

    .product-rank-item:hover {
        background: rgba(15, 23, 42, 0.6);
        transform: translateY(-2px);
    }

    .glass-card-dark {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(59, 130, 246, 0.1);
    }

    .logo-vms {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .permission-title {
        color: var(--accent-blue);
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.3);
    }

    .text-shadow-white {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .text-shadow-blue {
        text-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }

    .spinner-border {
        width: 2rem;
        height: 2rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
let salesChart, statusChart, categoryChart, revenueChart, revenueByCategoryChart;

// Load dashboard summary on page load
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardSummary();
    loadSalesReport();

    // Load other tabs when clicked
    document.getElementById('inventory-tab').addEventListener('click', function() {
        loadInventoryReport();
    });

    document.getElementById('products-tab').addEventListener('click', function() {
        loadPopularProducts();
    });

    document.getElementById('revenue-tab').addEventListener('click', function() {
        loadRevenueData('monthly');
    });
});

function loadDashboardSummary() {
    fetch('{{ route('admin.ecommerce.reports.dashboard-summary') }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('todayRevenue').textContent = data.today_revenue;
            document.getElementById('yesterdayRevenue').textContent = data.yesterday_revenue;
            document.getElementById('todayOrders').textContent = data.today_orders;
            document.getElementById('pendingOrders').textContent = data.pending_orders;
            document.getElementById('lowStock').textContent = data.low_stock_count;
            document.getElementById('outOfStock').textContent = data.out_of_stock_count;
        });
}

function loadSalesReport() {
    fetch('{{ route('admin.ecommerce.reports.sales') }}')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Sales by day chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            if (salesChart) salesChart.destroy();

            const salesLabels = data.sales_by_day && data.sales_by_day.length > 0
                ? data.sales_by_day.map(item => item.date)
                : ['No Data'];
            const salesData = data.sales_by_day && data.sales_by_day.length > 0
                ? data.sales_by_day.map(item => item.total)
                : [0];

            salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        label: 'Revenue (৳)',
                        data: salesData,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#fff' } } },
                    scales: {
                        y: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });

            // Sales by status chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            if (statusChart) statusChart.destroy();

            const statusLabels = data.sales_by_status && data.sales_by_status.length > 0
                ? data.sales_by_status.map(item => item.status)
                : ['No Orders'];
            const statusData = data.sales_by_status && data.sales_by_status.length > 0
                ? data.sales_by_status.map(item => item.total)
                : [1];

            statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusData,
                        backgroundColor: ['#fbbf24', '#3b82f6', '#22c55e', '#ef4444', '#a855f7']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#fff' } } }
                }
            });

            // Top products table
            const tbody = document.getElementById('topProductsBody');
            if (data.top_products && data.top_products.length > 0) {
                tbody.innerHTML = data.top_products.map(product => `
                    <tr>
                        <td>
                            <div class="fw-700 text-white">${product.product?.name_en || 'N/A'}</div>
                            <div style="font-size: 0.75rem; opacity: 0.6;">${product.product?.name_bn || ''}</div>
                        </td>
                        <td><span class="badge badge-visit-type">${product.product?.category?.name_en || 'N/A'}</span></td>
                        <td><span class="badge badge-visit-type">${product.total_sold}</span></td>
                        <td><span class="text-success fw-700">৳${product.revenue}</span></td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="fas fa-box-open" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">No sales data yet</div>
                        </td>
                    </tr>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading sales report:', error);
            const tbody = document.getElementById('topProductsBody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <i class="fas fa-exclamation-circle" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                        <div class="text-white" style="opacity: 0.5;">Error loading sales data</div>
                    </td>
                </tr>
            `;
        });
}

function loadInventoryReport() {
    fetch('{{ route('admin.ecommerce.reports.inventory') }}')
        .then(response => response.json())
        .then(data => {
            // Update summary cards
            document.getElementById('totalProducts').textContent = data.summary.total_products;
            document.getElementById('activeProducts').textContent = data.summary.active_products;
            document.getElementById('lowStockProducts').textContent = data.summary.low_stock;
            document.getElementById('outOfStockProducts').textContent = data.summary.out_of_stock;
            document.getElementById('inventoryValue').textContent = data.summary.total_inventory_value;

            // Products by category chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            if (categoryChart) categoryChart.destroy();
            categoryChart = new Chart(categoryCtx, {
                type: 'pie',
                data: {
                    labels: data.products_by_category.map(item => item.category),
                    datasets: [{
                        data: data.products_by_category.map(item => item.count),
                        backgroundColor: ['#3b82f6', '#22c55e', '#fbbf24', '#ef4444', '#a855f7', '#8b5cf6', '#6b7280']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#fff' } } }
                }
            });

            // Low stock table
            const tbody = document.getElementById('lowStockTableBody');
            if (data.low_stock_products && data.low_stock_products.length > 0) {
                tbody.innerHTML = data.low_stock_products.map(product => `
                    <tr>
                        <td>
                            <div class="fw-700 text-white">${product.name_en}</div>
                            <div style="font-size: 0.75rem; opacity: 0.6;">${product.name_bn}</div>
                        </td>
                        <td><code style="color: #fbbf24;">${product.sku}</code></td>
                        <td><span class="badge ${product.stock <= 5 ? 'badge-cancelled' : 'badge-pending'}">${product.stock}</span></td>
                        <td>
                            ${product.stock === 0 ? '<span class="badge badge-cancelled">Out of Stock</span>' :
                              product.stock <= 5 ? '<span class="badge badge-cancelled">Critical</span>' :
                              '<span class="badge badge-pending">Low</span>'}
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="fas fa-check-circle" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <div class="text-white" style="opacity: 0.5;">All products are well stocked!</div>
                        </td>
                    </tr>
                `;
            }
        });
}

function loadPopularProducts() {
    fetch('{{ route('admin.ecommerce.reports.popular-products') }}')
        .then(response => response.json())
        .then(data => {
            // Most sold
            const mostSold = document.getElementById('mostSoldList');
            if (data.most_sold && data.most_sold.length > 0) {
                mostSold.innerHTML = data.most_sold.map((item, index) => `
                    <div class="product-rank-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800;">
                                    ${index + 1}
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-700 text-white" style="font-size: 0.9rem;">${item.product?.name_en || 'N/A'}</div>
                                <div style="font-size: 0.75rem; opacity: 0.6;">${item.product?.category?.name_en || 'N/A'}</div>
                            </div>
                            <div class="text-end">
                                <div class="text-white fw-700">${item.total_sold}</div>
                                <div class="text-success" style="font-size: 0.8rem;">৳${item.revenue}</div>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                mostSold.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-box-open" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                        <div class="text-white" style="opacity: 0.5;">No sales yet</div>
                    </div>
                `;
            }

            // Most viewed
            const mostViewed = document.getElementById('mostViewedList');
            if (data.most_viewed && data.most_viewed.length > 0) {
                mostViewed.innerHTML = data.most_viewed.map((product, index) => `
                    <div class="product-rank-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #22c55e, #10b981); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800;">
                                    ${index + 1}
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-700 text-white" style="font-size: 0.9rem;">${product.name_en}</div>
                                <div style="font-size: 0.75rem; opacity: 0.6;">${product.category?.name_en || 'N/A'}</div>
                            </div>
                            <div class="text-end">
                                <div class="text-white fw-700">${product.views}</div>
                                <div style="font-size: 0.75rem; opacity: 0.6;">views</div>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                mostViewed.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-eye" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                        <div class="text-white" style="opacity: 0.5;">No views yet</div>
                    </div>
                `;
            }

            // Top rated
            const topRated = document.getElementById('topRatedList');
            if (data.top_rated && data.top_rated.length > 0) {
                topRated.innerHTML = data.top_rated.map((product, index) => `
                    <div class="product-rank-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800;">
                                    ${index + 1}
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-700 text-white" style="font-size: 0.9rem;">${product.name_en}</div>
                                <div style="color: #fbbf24; font-size: 0.8rem;">
                                    ${'★'.repeat(Math.round(product.average_rating))}${'☆'.repeat(5 - Math.round(product.average_rating))}
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="text-white fw-700">${product.average_rating.toFixed(1)}</div>
                                <div style="font-size: 0.75rem; opacity: 0.6;">${product.reviews_count} reviews</div>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                topRated.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-star" style="font-size: 48px; opacity: 0.3; margin-bottom: 1rem;"></i>
                        <div class="text-white" style="opacity: 0.5;">No reviews yet</div>
                    </div>
                `;
            }
        });
}

function loadRevenueData(period) {
    // Update active button
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.style.background = 'transparent';
        btn.style.borderColor = 'rgba(255,255,255,0.2)';
    });
    event.target.classList.add('active');
    event.target.style.background = 'var(--accent-blue)';
    event.target.style.borderColor = 'var(--accent-blue)';

    fetch(`{{ route('admin.ecommerce.reports.revenue') }}?period=${period}`)
        .then(response => response.json())
        .then(data => {
            // Update forecast
            document.getElementById('lastMonthRevenue').textContent = data.forecast?.last_month_revenue || '0';
            document.getElementById('forecastRevenue').textContent = data.forecast?.forecast || '0';
            document.getElementById('revenueGrowthRate').textContent = (data.forecast?.growth_rate || 0) + '%';

            // Revenue chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            if (revenueChart) revenueChart.destroy();

            const revenueLabels = data.revenue_data && data.revenue_data.length > 0
                ? data.revenue_data.map(item => item.date)
                : ['No Data'];
            const revenueData = data.revenue_data && data.revenue_data.length > 0
                ? data.revenue_data.map(item => item.revenue)
                : [0];
            const cumulativeData = data.revenue_data && data.revenue_data.length > 0
                ? data.revenue_data.map(item => item.cumulative)
                : [0];

            revenueChart = new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: revenueLabels,
                    datasets: [
                        {
                            label: 'Revenue',
                            data: revenueData,
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Cumulative',
                            data: cumulativeData,
                            borderColor: 'rgb(168, 85, 247)',
                            backgroundColor: 'rgba(168, 85, 247, 0.2)',
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#fff' } } },
                    scales: {
                        y: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });

            // Revenue by category chart
            const revCatCtx = document.getElementById('revenueByCategoryChart').getContext('2d');
            if (revenueByCategoryChart) revenueByCategoryChart.destroy();

            const categoryLabels = data.revenue_by_category && data.revenue_by_category.length > 0
                ? data.revenue_by_category.map(item => item.category)
                : ['No Data'];
            const categoryRevenue = data.revenue_by_category && data.revenue_by_category.length > 0
                ? data.revenue_by_category.map(item => item.revenue)
                : [0];

            revenueByCategoryChart = new Chart(revCatCtx, {
                type: 'bar',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        label: 'Revenue (৳)',
                        data: categoryRevenue,
                        backgroundColor: ['#3b82f6', '#22c55e', '#fbbf24', '#ef4444', '#a855f7', '#8b5cf6']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } }
                    }
                }
            });
        });
}
</script>
@endpush
