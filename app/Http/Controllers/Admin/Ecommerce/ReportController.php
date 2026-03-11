<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the main reports dashboard.
     */
    public function index()
    {
        return view('admin.ecommerce.reports.index');
    }

    /**
     * Get sales report data.
     */
    public function sales(Request $request)
    {
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRevenue = $orders->sum('final_amount');
        $totalDiscount = $orders->sum('discount');
        $totalOrders = $orders->count();
        $averageOrderValue = $orders->avg('final_amount');

        // Sales by day
        $salesByDay = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(final_amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Sales by status
        $salesByStatus = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(final_amount) as total'))
            ->groupBy('status')
            ->get();

        // Top selling products
        $topProducts = OrderItem::whereHas('order', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(price * quantity) as revenue'))
            ->with('product.category')
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(10)
            ->get()
            ->filter(function ($item) {
                return $item->product !== null;
            })
            ->values(); // Reset collection keys after filtering

        return response()->json([
            'summary' => [
                'total_revenue' => number_format($totalRevenue, 2),
                'total_discount' => number_format($totalDiscount, 2),
                'total_orders' => $totalOrders,
                'average_order_value' => number_format($averageOrderValue, 2),
            ],
            'sales_by_day' => $salesByDay,
            'sales_by_status' => $salesByStatus,
            'top_products' => $topProducts,
        ]);
    }

    /**
     * Get inventory report data.
     */
    public function inventory()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $inactiveProducts = Product::where('is_active', false)->count();
        $outOfStock = Product::where('stock', 0)->count();
        $lowStock = Product::where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $featuredProducts = Product::where('is_featured', true)->count();

        // Products by category
        $productsByCategory = Category::withCount('products')
            ->get()
            ->map(function ($category) {
                return [
                    'category' => $category->name_en,
                    'count' => $category->products_count,
                ];
            });

        // Low stock products
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->where('is_active', true)
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();

        // Out of stock products
        $outOfStockProducts = Product::where('stock', 0)
            ->where('is_active', true)
            ->latest()
            ->limit(10)
            ->get();

        // Total inventory value
        $totalInventoryValue = Product::select(DB::raw('SUM(stock * price) as total_value'))
            ->first()
            ->total_value ?? 0;

        return response()->json([
            'summary' => [
                'total_products' => $totalProducts,
                'active_products' => $activeProducts,
                'inactive_products' => $inactiveProducts,
                'out_of_stock' => $outOfStock,
                'low_stock' => $lowStock,
                'featured_products' => $featuredProducts,
                'total_inventory_value' => number_format($totalInventoryValue, 2),
            ],
            'products_by_category' => $productsByCategory,
            'low_stock_products' => $lowStockProducts,
            'out_of_stock_products' => $outOfStockProducts,
        ]);
    }

    /**
     * Get popular products data.
     */
    public function popularProducts(Request $request)
    {
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        // Most sold products
        $mostSold = OrderItem::whereHas('order', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(price * quantity) as revenue'), DB::raw('COUNT(DISTINCT order_id) as orders'))
            ->with('product.category')
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(20)
            ->get();

        // Most viewed products
        $mostViewed = Product::where('is_active', true)
            ->orderBy('views', 'desc')
            ->limit(20)
            ->get();

        // Most ordered products (order frequency)
        $mostOrdered = OrderItem::whereHas('order', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->select('product_id', DB::raw('COUNT(DISTINCT order_id) as order_count'))
            ->with('product')
            ->groupBy('product_id')
            ->orderBy('order_count', 'desc')
            ->limit(20)
            ->get();

        // Top rated products
        $topRated = Product::where('is_active', true)
            ->whereHas('reviews')
            ->with('category')
            ->get()
            ->map(function ($product) {
                $product->average_rating = $product->reviews()->where('is_approved', true)->avg('rating') ?? 0;
                $product->reviews_count = $product->reviews()->where('is_approved', true)->count();
                return $product;
            })
            ->sortByDesc('average_rating')
            ->take(20)
            ->values();

        return response()->json([
            'most_sold' => $mostSold,
            'most_viewed' => $mostViewed,
            'most_ordered' => $mostOrdered,
            'top_rated' => $topRated,
        ]);
    }

    /**
     * Get revenue data with charts.
     */
    public function revenue(Request $request)
    {
        $period = $request->get('period', 'monthly'); // daily, weekly, monthly, yearly

        $startDate = match($period) {
            'daily' => now()->subDays(7),
            'weekly' => now()->subWeeks(4),
            'monthly' => now()->subMonths(12),
            'yearly' => now()->subYears(5),
            default => now()->subMonths(12),
        };

        $revenueData = Order::where('created_at', '>=', $startDate)
            ->where('status', '!=', 'cancelled')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(final_amount) as revenue'), DB::raw('COUNT(*) as orders'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Monthly comparison
        $monthlyComparison = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(final_amount) as revenue'),
            DB::raw('COUNT(*) as orders')
        )
            ->where('created_at', '>=', now()->subYear())
            ->where('status', '!=', 'cancelled')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Revenue by category
        $revenueByCategory = OrderItem::whereHas('order', function ($query) use ($startDate) {
            $query->where('created_at', '>=', $startDate)->where('status', '!=', 'cancelled');
        })
            ->select('product_id', DB::raw('SUM(price * quantity) as revenue'))
            ->with('product.category')
            ->groupBy('product_id')
            ->get()
            ->groupBy('product.category.id')
            ->map(function ($items, $categoryId) {
                $firstItem = $items->first();
                return [
                    'category' => $firstItem->product->category->name_en ?? 'Uncategorized',
                    'revenue' => $items->sum('revenue'),
                ];
            })
            ->sortByDesc('revenue')
            ->values();

        // Cumulative revenue
        $cumulativeRevenue = 0;
        $cumulativeData = $revenueData->map(function ($item) use (&$cumulativeRevenue) {
            $cumulativeRevenue += $item->revenue;
            return [
                'date' => $item->date,
                'revenue' => $item->revenue,
                'cumulative' => $cumulativeRevenue,
            ];
        });

        // Forecast (simple trend calculation)
        $lastMonthRevenue = Order::where('created_at', '>=', now()->subMonth())
            ->where('status', '!=', 'cancelled')
            ->sum('final_amount');

        $previousMonthRevenue = Order::whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])
            ->where('status', '!=', 'cancelled')
            ->sum('final_amount');

        $growthRate = $previousMonthRevenue > 0
            ? (($lastMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100
            : 0;

        $forecast = $lastMonthRevenue * (1 + ($growthRate / 100));

        return response()->json([
            'revenue_data' => $cumulativeData,
            'monthly_comparison' => $monthlyComparison,
            'revenue_by_category' => $revenueByCategory,
            'forecast' => [
                'last_month_revenue' => number_format($lastMonthRevenue, 2),
                'previous_month_revenue' => number_format($previousMonthRevenue, 2),
                'growth_rate' => number_format($growthRate, 2),
                'forecast' => number_format($forecast, 2),
            ],
        ]);
    }

    /**
     * Get dashboard summary.
     */
    public function dashboardSummary()
    {
        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->sum('final_amount');

        $yesterdayRevenue = Order::whereDate('created_at', now()->subDay())
            ->where('status', '!=', 'cancelled')
            ->sum('final_amount');

        $todayOrders = Order::whereDate('created_at', today())->count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $lowStockCount = Product::where('stock', '<=', 10)->where('stock', '>', 0)->count();

        $outOfStockCount = Product::where('stock', 0)->count();

        return response()->json([
            'today_revenue' => number_format($todayRevenue, 2),
            'yesterday_revenue' => number_format($yesterdayRevenue, 2),
            'today_orders' => $todayOrders,
            'pending_orders' => $pendingOrders,
            'low_stock_count' => $lowStockCount,
            'out_of_stock_count' => $outOfStockCount,
        ]);
    }
}
