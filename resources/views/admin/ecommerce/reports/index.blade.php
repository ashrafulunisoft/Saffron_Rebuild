@extends('layouts.admin')

@section('title', 'Reports & Analytics - Saffron Admin')

@push('styles')
<style>
    .report-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3) !important;
    }
    .chart-container {
        position: relative;
        height: 300px;
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: bold;
    }
</style>
@endpush

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Reports & Analytics <span class="text-white">রিপোর্ট ও বিশ্লেষণ</span></h2>
        <p class="text-white mb-0">Sales, inventory, and performance reports</p>
    </div>
</div>

<!-- Dashboard Summary -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-dark border-secondary report-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary rounded p-3">
                            <i class="fas fa-dollar-sign text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Today's Revenue</h6>
                        <h4 class="fw-bold text-white mb-0" id="todayRevenue">৳0.00</h4>
                        <small class="text-muted">Yesterday: ৳<span id="yesterdayRevenue">0.00</span></small>
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
                            <i class="fas fa-shopping-cart text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Today's Orders</h6>
                        <h4 class="fw-bold text-white mb-0" id="todayOrders">0</h4>
                        <small class="text-muted">Pending: <span id="pendingOrders">0</span></small>
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
                            <i class="fas fa-exclamation-triangle text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Low Stock</h6>
                        <h4 class="fw-bold text-white mb-0" id="lowStock">0</h4>
                        <small class="text-muted">Out of Stock: <span id="outOfStock">0</span></small>
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
                        <div class="bg-info rounded p-3">
                            <i class="fas fa-chart-line text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Growth Rate</h6>
                        <h4 class="fw-bold text-white mb-0" id="growthRate">0%</h4>
                        <small class="text-muted">vs last month</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Report Tabs -->
<div class="glass-card mb-4">
    <div class="card-body bg-dark">
        <ul class="nav nav-tabs" id="reportTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-white" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab">
                    <i class="fas fa-chart-bar me-2"></i>Sales Reports
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-white" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab">
                    <i class="fas fa-boxes me-2"></i>Inventory Reports
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-white" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">
                    <i class="fas fa-star me-2"></i>Popular Products
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-white" id="revenue-tab" data-bs-toggle="tab" data-bs-target="#revenue" type="button" role="tab">
                    <i class="fas fa-chart-line me-2"></i>Revenue Charts
                </button>
            </li>
        </ul>
    </div>
</div>

<!-- Tab Content -->
<div class="tab-content" id="reportTabContent">

    <!-- Sales Reports -->
    <div class="tab-pane fade show active" id="sales" role="tabpanel">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="glass-card">
                    <h5 class="text-white mb-3">Revenue Chart</h5>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card">
                    <h5 class="text-white mb-3">Sales by Status</h5>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="card-header bg-info border-secondary">
                <h5 class="text-white mb-0"><i class="fas fa-trophy me-2"></i>Top Selling Products</h5>
            </div>
            <div class="card-body bg-dark">
                <div class="table-responsive">
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th class="text-white">Product</th>
                                <th class="text-white">Category</th>
                                <th class="text-white">Units Sold</th>
                                <th class="text-white">Revenue</th>
                            </tr>
                        </thead>
                        <tbody id="topProductsBody">
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Reports -->
    <div class="tab-pane fade" id="inventory" role="tabpanel">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-box text-white fs-1 mb-2"></i>
                        <h3 class="fw-bold text-white mb-0" id="totalProducts">0</h3>
                        <small class="text-white">Total Products</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-white fs-1 mb-2"></i>
                        <h3 class="fw-bold text-white mb-0" id="activeProducts">0</h3>
                        <small class="text-white">Active Products</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation text-white fs-1 mb-2"></i>
                        <h3 class="fw-bold text-white mb-0" id="lowStockProducts">0</h3>
                        <small class="text-white">Low Stock (≤10)</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-times-circle text-white fs-1 mb-2"></i>
                        <h3 class="fw-bold text-white mb-0" id="outOfStockProducts">0</h3>
                        <small class="text-white">Out of Stock</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="glass-card">
                    <h5 class="text-white mb-3">Products by Category</h5>
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card">
                    <h5 class="text-white mb-3">Inventory Value</h5>
                    <div class="text-center py-5">
                        <h2 class="text-success mb-2">৳<span id="inventoryValue">0.00</span></h2>
                        <p class="text-white">Total Inventory Value</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="card-header bg-warning border-secondary">
                <h5 class="text-white mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Low Stock Alert</h5>
            </div>
            <div class="card-body bg-dark">
                <div class="table-responsive">
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th class="text-white">Product</th>
                                <th class="text-white">SKU</th>
                                <th class="text-white">Current Stock</th>
                                <th class="text-white">Status</th>
                            </tr>
                        </thead>
                        <tbody id="lowStockTableBody">
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Products -->
    <div class="tab-pane fade" id="products" role="tabpanel">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="glass-card">
                    <div class="card-header bg-warning border-secondary">
                        <h5 class="text-white mb-0">Most Sold</h5>
                    </div>
                    <div class="card-body bg-dark" style="max-height: 400px; overflow-y: auto;">
                        <div id="mostSoldList"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card">
                    <div class="card-header bg-info border-secondary">
                        <h5 class="text-white mb-0">Most Viewed</h5>
                    </div>
                    <div class="card-body bg-dark" style="max-height: 400px; overflow-y: auto;">
                        <div id="mostViewedList"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card">
                    <div class="card-header bg-success border-secondary">
                        <h5 class="text-white mb-0">Top Rated</h5>
                    </div>
                    <div class="card-body bg-dark" style="max-height: 400px; overflow-y: auto;">
                        <div id="topRatedList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Charts -->
    <div class="tab-pane fade" id="revenue" role="tabpanel">
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="glass-card">
                    <h5 class="text-white mb-3">Revenue Trend</h5>
                    <div class="d-flex gap-2 mb-3">
                        <button class="btn btn-sm btn-gradient" onclick="loadRevenueData('daily')">7 Days</button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="loadRevenueData('weekly')">4 Weeks</button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="loadRevenueData('monthly')">12 Months</button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="loadRevenueData('yearly')">5 Years</button>
                    </div>
                    <div class="chart-container" style="height: 350px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card">
                    <h5 class="text-white mb-3">Forecast</h5>
                    <div class="card-body bg-dark">
                        <div class="text-center mb-4">
                            <h6 class="text-muted">Last Month Revenue</h6>
                            <h3 class="text-success mb-0">৳<span id="lastMonthRevenue">0.00</span></h3>
                        </div>
                        <div class="text-center mb-4">
                            <h6 class="text-muted">Next Month Forecast</h6>
                            <h3 class="text-info mb-0">৳<span id="forecastRevenue">0.00</span></h3>
                        </div>
                        <div class="text-center">
                            <h6 class="text-muted">Growth Rate</h6>
                            <h3 class="text-white mb-0" id="revenueGrowthRate">0%</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <h5 class="text-white mb-3">Revenue by Category</h5>
            <div class="chart-container" style="height: 300px;">
                <canvas id="revenueByCategoryChart"></canvas>
            </div>
        </div>
    </div>

</div>

@endsection

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
            document.getElementById('todayRevenue').textContent = '৳' + data.today_revenue;
            document.getElementById('yesterdayRevenue').textContent = data.yesterday_revenue;
            document.getElementById('todayOrders').textContent = data.today_orders;
            document.getElementById('pendingOrders').textContent = data.pending_orders;
            document.getElementById('lowStock').textContent = data.low_stock_count;
            document.getElementById('outOfStock').textContent = data.out_of_stock_count;
        });
}

function loadSalesReport() {
    fetch('{{ route('admin.ecommerce.reports.sales') }}')
        .then(response => response.json())
        .then(data => {
            // Update summary
            document.getElementById('growthRate').textContent = data.forecast?.growth_rate + '%';

            // Sales by day chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            if (salesChart) salesChart.destroy();
            salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: data.sales_by_day.map(item => item.date),
                    datasets: [{
                        label: 'Revenue (৳)',
                        data: data.sales_by_day.map(item => item.total),
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#fff' } } },
                    scales: {
                        y: { ticks: { color: '#fff' }, grid: { color: '#495057' } },
                        x: { ticks: { color: '#fff' }, grid: { color: '#495057' } }
                    }
                }
            });

            // Sales by status chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            if (statusChart) statusChart.destroy();
            statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: data.sales_by_status.map(item => item.status),
                    datasets: [{
                        data: data.sales_by_status.map(item => item.total),
                        backgroundColor: ['#ffc107', '#17a2b8', '#28a745', '#dc3545', '#6c757d']
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
            tbody.innerHTML = data.top_products.map(product => `
                <tr>
                    <td>
                        <div class="fw-bold text-white">${product.product?.name_en || 'N/A'}</div>
                        <small class="text-info">${product.product?.name_bn || ''}</small>
                    </td>
                    <td><span class="badge bg-secondary">${product.product?.category?.name_en || 'N/A'}</span></td>
                    <td><span class="badge bg-primary">${product.total_sold}</span></td>
                    <td><span class="text-success fw-bold">৳${product.revenue}</span></td>
                </tr>
            `).join('');
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
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF']
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
            tbody.innerHTML = data.low_stock_products.map(product => `
                <tr>
                    <td>
                        <div class="fw-bold text-white">${product.name_en}</div>
                        <small class="text-info">${product.name_bn}</small>
                    </td>
                    <td><code class="text-warning">${product.sku}</code></td>
                    <td><span class="badge ${product.stock <= 5 ? 'bg-danger' : 'bg-warning'}">${product.stock}</span></td>
                    <td>
                        ${product.stock === 0 ? '<span class="badge bg-danger">Out of Stock</span>' :
                          product.stock <= 5 ? '<span class="badge bg-danger">Critical</span>' :
                          '<span class="badge bg-warning">Low</span>'}
                    </td>
                </tr>
            `).join('');
        });
}

function loadPopularProducts() {
    fetch('{{ route('admin.ecommerce.reports.popular-products') }}')
        .then(response => response.json())
        .then(data => {
            // Most sold
            const mostSold = document.getElementById('mostSoldList');
            mostSold.innerHTML = data.most_sold.map((item, index) => `
                <div class="d-flex align-items-center mb-3 p-2 bg-secondary rounded">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            ${index + 1}
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fw-bold text-white">${item.product?.name_en || 'N/A'}</div>
                        <small class="text-info">${item.product?.category?.name_en || 'N/A'}</small>
                    </div>
                    <div class="text-end">
                        <div class="text-white">${item.total_sold} sold</div>
                        <small class="text-success">৳${item.revenue}</small>
                    </div>
                </div>
            `).join('');

            // Most viewed
            const mostViewed = document.getElementById('mostViewedList');
            mostViewed.innerHTML = data.most_viewed.map((product, index) => `
                <div class="d-flex align-items-center mb-3 p-2 bg-secondary rounded">
                    <div class="flex-shrink-0">
                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            ${index + 1}
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fw-bold text-white">${product.name_en}</div>
                        <small class="text-info">${product.category?.name_en || 'N/A'}</small>
                    </div>
                    <div class="text-end">
                        <div class="text-white">${product.views} views</div>
                    </div>
                </div>
            `).join('');

            // Top rated
            const topRated = document.getElementById('topRatedList');
            topRated.innerHTML = data.top_rated.map((product, index) => `
                <div class="d-flex align-items-center mb-3 p-2 bg-secondary rounded">
                    <div class="flex-shrink-0">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            ${index + 1}
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fw-bold text-white">${product.name_en}</div>
                        <div class="text-warning">
                            ${'★'.repeat(Math.round(product.average_rating))}${'☆'.repeat(5 - Math.round(product.average_rating))}
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="text-white">${product.average_rating.toFixed(1)}</div>
                        <small class="text-muted">${product.reviews_count} reviews</small>
                    </div>
                </div>
            `).join('');
        });
}

function loadRevenueData(period) {
    fetch(`{{ route('admin.ecommerce.reports.revenue') }}?period=${period}`)
        .then(response => response.json())
        .then(data => {
            // Update forecast
            document.getElementById('lastMonthRevenue').textContent = data.forecast.last_month_revenue;
            document.getElementById('forecastRevenue').textContent = data.forecast.forecast;
            document.getElementById('revenueGrowthRate').textContent = data.forecast.growth_rate + '%';

            // Revenue chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            if (revenueChart) revenueChart.destroy();
            revenueChart = new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: data.revenue_data.map(item => item.date),
                    datasets: [
                        {
                            label: 'Revenue',
                            data: data.revenue_data.map(item => item.revenue),
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Cumulative',
                            data: data.revenue_data.map(item => item.cumulative),
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
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
                        y: { ticks: { color: '#fff' }, grid: { color: '#495057' } },
                        x: { ticks: { color: '#fff' }, grid: { color: '#495057' } }
                    }
                }
            });

            // Revenue by category chart
            const revCatCtx = document.getElementById('revenueByCategoryChart').getContext('2d');
            if (revenueByCategoryChart) revenueByCategoryChart.destroy();
            revenueByCategoryChart = new Chart(revCatCtx, {
                type: 'bar',
                data: {
                    labels: data.revenue_by_category.map(item => item.category),
                    datasets: [{
                        label: 'Revenue (৳)',
                        data: data.revenue_by_category.map(item => item.revenue),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { ticks: { color: '#fff' }, grid: { color: '#495057' } },
                        x: { ticks: { color: '#fff' }, grid: { color: '#495057' } }
                    }
                }
            });
        });
}
</script>
@endpush
