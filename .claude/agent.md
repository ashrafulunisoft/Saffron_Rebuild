# Saffron Ecommerce Agent Configuration

## Project Overview

**Project Name:** Saffron Bakery Ecommerce System
**Framework:** Laravel 11
**Goal:** Build a complete Bengali-English bilingual ecommerce system for bakery products
**Timeline:** 2-4 days (fast modular implementation)

## Existing Infrastructure (Already Built)

✅ **Authentication System:**
- Login/Registration with Laravel Breeze or similar
- RBAC (Role-Based Access Control) with permissions
- User management

✅ **Communication:**
- SMS notification system
- Email notification system

✅ **Database Migrations (Created):**
- Categories (Bangla + English support)
- Products (SKU, bilingual names, pricing, stock)
- Product Images (primary image support)
- Tags (Bangla tags: তাজা, নরম, হালাল, বিএসটিআই)
- Product-Tag relationships
- Cart system
- Orders & Order Items
- Coupons (percent/fixed discounts)
- Reviews & Ratings
- Reward Points System

✅ **Models (Created):**
- Category, Product, ProductImage, Tag
- Cart, Order, OrderItem
- Coupon, Review, PointTransaction
- User (extended for ecommerce)

## Project Architecture

### 1. **Multilingual Product Catalog**

**Database Structure:**
```php
Products Table:
- sku (unique identifier)
- name_en, name_bn (English + Bengali names)
- slug (SEO-friendly URL)
- description_en, description_bn
- price, sale_price
- stock
- category_id (foreign key)
- views (popularity tracking)
- is_featured, is_active
```

**Key Features:**
- SKU-based catalog matching uploaded Bengali product document
- Bilingual search and display
- Category hierarchy (parent-child relationships)
- Tag system for freshness, quality, certifications

### 2. **Shopping Cart System**

**Features:**
- User-specific cart (guest cart optional)
- Quantity management
- Real-time stock validation
- Coupon application
- Price calculation with discounts

### 3. **Order Management**

**Order Flow:**
```
Cart → Checkout → Order Creation → Payment → Processing → Shipment → Delivery
```

**Order Status:**
- pending, confirmed, processing, shipped, delivered, cancelled

**Payment Integration:**
- COD (Cash on Delivery)
- Mobile Banking (bKash, Nagad, Rocket - Bangladesh)
- Bank transfer options

### 4. **Customer Features**

- Wishlist functionality
- Order history with tracking
- Review & rating system
- Reward points (earn on purchase, redeem on next order)
- Profile management with shipping addresses

### 5. **Admin Panel**

**Dashboard:**
- Sales statistics (daily, weekly, monthly)
- Top-selling products
- Low stock alerts
- Pending orders

**Product Management:**
- CRUD operations for products
- Bulk upload (CSV/Excel) for 40+ Bengali products
- Image upload (multiple images)
- Stock management
- Category/tag management

**Order Management:**
- View all orders
- Update order status
- Generate invoices
- Shipping label generation

## Implementation Steps (2-4 Days)

### **Phase 1: Core Ecommerce Controllers (Day 1)**

#### 1.1 Create Ecommerce Controllers Structure

```bash
php artisan make:controller Shop/ProductController
php artisan make:controller Shop/CartController
php artisan make:controller Shop/CheckoutController
php artisan make:controller Shop/OrderController
php artisan make:controller Admin/ProductController
php artisan make:controller Admin/OrderController
php artisan make:controller Admin/CategoryController
php artisan make:controller Admin/CouponController
```

**Location:** `app/Http/Controllers/Shop/` & `app/Http/Controllers/Admin/`

#### 1.2 Product Catalog Features

**Customer Routes (routes/web.php):**
```php
// Product Catalog
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ProductController::class, 'show'])->name('shop.show');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('shop.category');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{orderNumber}', [OrderController::class, 'show'])->name('orders.show');
```

#### 1.3 Key Query Patterns

**Best Selling Products:**
```php
Product::withCount('orderItems')
    ->orderBy('order_items_count', 'desc')
    ->take(10)
    ->get();
```

**Popular Products (by views):**
```php
Product::orderBy('views', 'desc')->take(10)->get();
```

**New Arrivals:**
```php
Product::latest()->take(10)->get();
```

**Featured Products:**
```php
Product::featured()->active()->get();
```

### **Phase 2: Views & Frontend (Day 2)**

#### 2.1 Create Shop Views Structure

```bash
mkdir -p resources/views/shop
mkdir -p resources/views/shop/products
mkdir -p resources/views/shop/cart
mkdir -p resources/views/shop/checkout
mkdir -p resources/views/shop/orders
mkdir -p resources/views/admin/ecommerce
```

**Required Blade Templates:**

**Shop Frontend:**
```
resources/views/shop/
├── layout.blade.php (main shop layout)
├── home.blade.php (shop homepage)
├── products/
│   ├── index.blade.php (product listing)
│   ├── show.blade.php (product details)
│   └── partials/
│       ├── product-card.blade.php
│       └── filters.blade.php
├── cart/
│   └── index.blade.php
├── checkout/
│   └── index.blade.php
└── orders/
    ├── index.blade.php (my orders)
    └── show.blade.php (order details)
```

**Admin Panel:**
```
resources/views/admin/ecommerce/
├── dashboard.blade.php
├── products/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── orders/
│   ├── index.blade.php
│   └── show.blade.php
├── categories/
│   └── index.blade.php
└── coupons/
    └── index.blade.php
```

#### 2.2 Language Toggle Component

Create language switcher for Bangla/English:
```php
// App\Http\Middleware\SetLocale
public function handle($request, Closure $next)
{
    app()->setLocale(session('locale', 'en'));
    return $next($request);
}
```

### **Phase 3: Advanced Features (Day 3)**

#### 3.1 Coupon System

**Controller Methods:**
```php
public function applyCoupon(Request $request)
{
    $coupon = Coupon::where('code', $request->code)
        ->where('expires_at', '>', now())
        ->where('usage_limit', '>', 0)
        ->first();

    if (!$coupon) {
        return back()->with('error', 'Invalid coupon code');
    }

    session(['coupon' => $coupon]);
    return back()->with('success', 'Coupon applied!');
}
```

#### 3.2 Review & Rating System

```php
// Store review
public function store(Request $request, Product $product)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:500'
    ]);

    Review::create([
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'rating' => $request->rating,
        'comment' => $request->comment
    ]);

    return back()->with('success', 'Review submitted!');
}
```

#### 3.3 Reward Points System

```php
// Earn points on order completion
public function earnPoints(Order $order)
{
    $points = floor($order->final_amount / 100); // 1 point per 100 TK

    PointTransaction::create([
        'user_id' => $order->user_id,
        'points' => $points,
        'type' => 'earn',
        'description' => "Order #{$order->order_number}"
    ]);
}

// Redeem points at checkout
public function redeemPoints(Request $request)
{
    $user = auth()->user();
    $availablePoints = $user->pointTransactions()
        ->where('type', 'earn')
        ->sum('points')
        - $user->pointTransactions()
        ->where('type', 'redeem')
        ->sum('points');

    $discount = min($availablePoints, $request->points_to_redeem);

    // Apply discount to order
}
```

### **Phase 4: Admin Panel (Day 4)**

#### 4.1 Admin Dashboard

```php
public function dashboard()
{
    $stats = [
        'today_sales' => Order::whereDate('created_at', today())->sum('final_amount'),
        'month_sales' => Order::whereMonth('created_at', now()->month)->sum('final_amount'),
        'pending_orders' => Order::where('status', 'pending')->count(),
        'low_stock' => Product::where('stock', '<', 10)->count(),
    ];

    $topProducts = Product::withCount('orderItems')
        ->orderBy('order_items_count', 'desc')
        ->take(5)
        ->get();

    return view('admin.ecommerce.dashboard', compact('stats', 'topProducts'));
}
```

#### 4.2 Product Bulk Upload

Create seeder for 40+ Bengali products:
```bash
php artisan make:seeder ProductSeeder
```

Include products from document:
- Cakes (কেক): Vanilla Sponge, Chocolate, Black Forest, etc.
- Breads (রুটি): White Bread, Brown Bread, Burger Bun
- Sweets (মিষ্টান্ন): Rosogolla, Sandesh, Gulab Jamun
- Snacks: Cookies, Biscuits, Pastries

#### 4.3 Order Management

```php
// Update order status
public function updateStatus(Request $request, Order $order)
{
    $order->update(['status' => $request->status]);

    // Send SMS notification
    if ($order->user->phone) {
        $this->sendOrderStatusSMS($order);
    }

    return back()->with('success', 'Order status updated!');
}
```

## Database Seeders (Ready for Import)

### Product Categories

```php
$categories = [
    ['name_en' => 'Cakes', 'name_bn' => 'কেক'],
    ['name_en' => 'Breads', 'name_bn' => 'রুটি'],
    ['name_en' => 'Sweets', 'name_bn' => 'মিষ্টান্ন'],
    ['name_en' => 'Cookies', 'name_bn' => 'কুকিজ'],
    ['name_en' => 'Pastries', 'name_bn' => 'পেস্ট্রি'],
    ['name_en' => 'Snacks', 'name_bn' => 'স্ন্যাকস'],
];
```

### Tags

```php
$tags = [
    ['name_en' => 'Fresh', 'name_bn' => 'তাজা'],
    ['name_en' => 'Soft', 'name_bn' => 'নরম'],
    ['name_en' => 'Halal', 'name_bn' => 'হালাল'],
    ['name_en' => 'BSTI Certified', 'name_bn' => 'বিএসটিআই'],
    ['name_en' => 'Homemade', 'name_bn' => 'হোমমেড'],
    ['name_en' => 'Sugar Free', 'name_bn' => 'সুগার ফ্রি'],
];
```

## API Endpoints (Optional - for Mobile App)

```php
// routes/api.php
Route::prefix('v1')->group(function () {
    Route::get('/products', [Api\ProductController::class, 'index']);
    Route::get('/products/{slug}', [Api\ProductController::class, 'show']);
    Route::post('/cart/add', [Api\CartController::class, 'add']);
    Route::post('/checkout', [Api\CheckoutController::class, 'store']);
});
```

## Testing Strategy

```bash
# Feature Tests
php artisan make:test Shop/CartTest
php artisan make:test Shop/CheckoutTest
php artisan make:test Admin/ProductManagementTest
```

## Deployment Checklist

- [ ] Run migrations: `php artisan migrate`
- [ ] Seed products: `php artisan db:seed --class=ProductSeeder`
- [ ] Link storage: `php artisan storage:link`
- [ ] Clear cache: `php artisan optimize:clear`
- [ ] Set up cron jobs for order status updates
- [ ] Configure SMS gateway for Bangladesh
- [ ] Set up payment gateways (bKash, Nagad)

## Key Design Patterns

1. **Repository Pattern** (Optional) for data access
2. **Service Classes** for business logic (CartService, OrderService)
3. **Events & Listeners** for order notifications
4. **Form Requests** for validation
5. **Resources** for API responses

## Quick Start Commands

```bash
# Create all controllers at once
php artisan make:controller Shop/ProductController --resource
php artisan make:controller Shop/CartController --resource
php artisan make:controller Shop/CheckoutController
php artisan make:controller Admin/ProductController --resource

# Create request classes
php artisan make:request StoreProductRequest
php artisan make:request PlaceOrderRequest

# Create events
php artisan make:event OrderPlaced
php artisan make:listener SendOrderNotification --event=OrderPlaced
```

## Notes

- All product names support Bengali & English
- Currency: Bangladeshi Taka (৳)
- Phone format: +880 for Bangladesh
- Date format: d-m-Y (Bengali calendar optional)
- Image storage: `storage/app/public/products`
- Default language: English (switchable to Bengali)

---

**Remember:** This is a MODULAR ecommerce system built into EXISTING Laravel project. Leverage existing auth, RBAC, SMS, and Email systems. Focus on ecommerce-specific features only.
