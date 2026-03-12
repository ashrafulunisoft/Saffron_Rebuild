<?php

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\ProfileController;

//for create role and permission :
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\VisitorExportController;






/*
|--------------------------------------------------------------------------
| Those use for role base redirection .
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    "This is the dashboard page for no roles";
    return view('dashboard'); // dummy view (never actually shown)
})->middleware(['auth', 'verified', 'role.redirect'])
  ->name('dashboard');




/*
|--------------------------------------------------------------------------
| Role-wise Dashboards
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Profile
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

    // Admin Live Dashboard
    Route::get('/admin/live-dashboard', [AdminController::class, 'liveDashboard'])->name('admin.live.dashboard');
    Route::get('/api/admin/visitors/live', [AdminController::class, 'liveVisitsApi'])->name('api.admin.visitors.live');

    // Admin Visitor Management Routes
    // Static routes MUST come before dynamic routes
    Route::get('/admin/visitor/pending', [AdminController::class, 'pendingVisits'])->name('admin.visitor.pending');
    Route::get('/admin/visitor/rejected', [AdminController::class, 'rejectedVisits'])->name('admin.visitor.rejected');
    Route::get('/admin/visitor/approved', [AdminController::class, 'approvedVisits'])->name('admin.visitor.approved');
    Route::get('/admin/visitor/history', [AdminController::class, 'visitHistory'])->name('admin.visitor.history');
    Route::get('/admin/visitor/active', [AdminController::class, 'activeVisits'])->name('admin.visitor.active');
    Route::get('/admin/visitor/checkin-checkout', [AdminController::class, 'checkinCheckout'])->name('admin.visitor.checkin-checkout');

    // API routes for admin
    Route::get('/admin/visitor/autofill', [AdminController::class, 'autofill'])->name('admin.visitor.autofill');
    Route::get('/admin/visitor/check-email', [AdminController::class, 'checkVisitorByEmail'])->name('admin.visitor.check-email');
    Route::get('/admin/visitor/check-email', [AdminController::class, 'checkVisitorByEmail'])->name('admin.visitor.registration.check-visitor');
    Route::get('/admin/visitor/check-phone', [AdminController::class, 'checkVisitorByPhone'])->name('admin.visitor.check-phone');
    Route::get('/admin/visitor/check-phone', [AdminController::class, 'checkVisitorByPhone'])->name('admin.visitor.registration.check-visitor-phone');
    Route::get('/admin/visitor/search-host', [AdminController::class, 'searchHost'])->name('admin.visitor.search-host');
    Route::get('/admin/visitor/search-host', [AdminController::class, 'searchHost'])->name('admin.visitor.registration.search-host');
    Route::get('/admin/visitor/statistics', [AdminController::class, 'statistics'])->name('admin.visitor.statistics');

    // CRUD routes (dynamic routes MUST come last)
    Route::get('/admin/visitor', [AdminController::class, 'visitorList'])->name('admin.visitor.index');
    Route::get('/admin/visitor', [AdminController::class, 'visitorList'])->name('admin.visitor.list');
    Route::get('/admin/visitor/create', [AdminController::class, 'createVisitorRegistration'])->name('admin.visitor.create');
    Route::get('/admin/visitor/create', [AdminController::class, 'createVisitorRegistration'])->name('admin.visitor.registration.create');
    Route::post('/admin/visitor', [AdminController::class, 'storeVisitorRegistration'])->name('admin.visitor.store');
    Route::post('/admin/visitor', [AdminController::class, 'storeVisitorRegistration'])->name('admin.visitor.registration.store');
    Route::get('/admin/visitor/{id}', [AdminController::class, 'showVisitor'])->name('admin.visitor.show');
    Route::get('/admin/visitor/{id}/edit', [AdminController::class, 'editVisitor'])->name('admin.visitor.edit');
    Route::post('/admin/visitor/{id}/update', [AdminController::class, 'updateVisitor'])->name('admin.visitor.update');
    Route::delete('/admin/visitor/{id}', [AdminController::class, 'deleteVisitor'])->name('admin.visitor.destroy');

    // OTP Verification Routes
    Route::get('/admin/visitor/{id}/verify-otp', [AdminController::class, 'showVerifyOtp'])->name('admin.visitor.verify.otp.view');
    Route::post('/admin/visitor/verify-otp/{id}', [AdminController::class, 'verifyOtp'])->name('admin.visitor.verify.otp');

    // Host Approval Routes
    Route::post('/admin/visits/{id}/approve', [AdminController::class, 'approveVisit'])->name('admin.visit.approve');
    Route::post('/admin/visits/{id}/reject', [AdminController::class, 'rejectVisit'])->name('admin.visit.reject');

    // Check-in/Check-out Routes
    Route::post('/admin/visits/{id}/check-in', [AdminController::class, 'checkIn'])->name('admin.visit.checkin');
    Route::post('/admin/visits/{id}/check-out', [AdminController::class, 'checkOut'])->name('admin.visit.checkout');

    // Admin Role Management Routes
    Route::get('/admin/role/create', [AdminController::class, 'createRole'])->name('admin.role.create');
    Route::post('/admin/role/store', [AdminController::class, 'storeRole'])->name('admin.role.store');
    Route::get('/admin/role/assign/create', [AdminController::class, 'createAssignRole'])->name('admin.role.assign.create');
    Route::post('/admin/role/assign/store', [AdminController::class, 'storeAssignRole'])->name('admin.role.assign.store');
    Route::post('/admin/role/assign/remove', [AdminController::class, 'removeUserRole'])->name('admin.role.assign.remove');

    /*
    |--------------------------------------------------------------------------
    | Admin Ecommerce Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/ecommerce')->name('admin.ecommerce.')->group(function () {
        // Categories
        Route::get('/categories', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'index'])
            ->name('categories.index');
        Route::get('/categories/create', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'create'])
            ->name('categories.create');
        Route::post('/categories', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'store'])
            ->name('categories.store');
        Route::get('/categories/{category}', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'show'])
            ->name('categories.show');
        Route::get('/categories/{category}/edit', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'edit'])
            ->name('categories.edit');
        Route::put('/categories/{category}', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'update'])
            ->name('categories.update');
        Route::delete('/categories/{category}', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'destroy'])
            ->name('categories.destroy');
        Route::post('/categories/{category}/toggle', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'toggleStatus'])
            ->name('categories.toggle');
        Route::get('/categories/search', [App\Http\Controllers\Admin\Ecommerce\CategoryController::class, 'search'])
            ->name('categories.search');

        // Products
        Route::get('/products', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'index'])
            ->name('products.index');
        Route::get('/products/create', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'create'])
            ->name('products.create');
        Route::post('/products', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'store'])
            ->name('products.store');
        Route::get('/products/{product}', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'show'])
            ->name('products.show');
        Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'edit'])
            ->name('products.edit');
        Route::put('/products/{product}', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'update'])
            ->name('products.update');
        Route::delete('/products/{product}', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'destroy'])
            ->name('products.destroy');
        Route::post('/products/{product}/toggle-featured', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'toggleFeatured'])
            ->name('products.toggle-featured');
        Route::post('/products/{product}/toggle-status', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'toggleStatus'])
            ->name('products.toggle-status');
        Route::get('/products/search', [App\Http\Controllers\Admin\Ecommerce\ProductController::class, 'search'])
            ->name('products.search');

        // Product Images
        Route::post('/products/{product}/images', [App\Http\Controllers\Admin\Ecommerce\ProductImageController::class, 'store'])
            ->name('products.images.store');
        Route::post('/products/{product}/images/{image}/primary', [App\Http\Controllers\Admin\Ecommerce\ProductImageController::class, 'setPrimary'])
            ->name('products.images.primary');
        Route::delete('/products/{product}/images/{image}', [App\Http\Controllers\Admin\Ecommerce\ProductImageController::class, 'destroy'])
            ->name('products.images.destroy');
        Route::put('/products/{product}/images/{image}', [App\Http\Controllers\Admin\Ecommerce\ProductImageController::class, 'update'])
            ->name('products.images.update');

        // Orders
        Route::get('/orders', [App\Http\Controllers\Admin\Ecommerce\OrderController::class, 'index'])
            ->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\Ecommerce\OrderController::class, 'show'])
            ->name('orders.show');
        Route::put('/orders/{order}', [App\Http\Controllers\Admin\Ecommerce\OrderController::class, 'update'])
            ->name('orders.update');
        Route::delete('/orders/{order}', [App\Http\Controllers\Admin\Ecommerce\OrderController::class, 'destroy'])
            ->name('orders.destroy');
        Route::post('/orders/{order}/status', [App\Http\Controllers\Admin\Ecommerce\OrderController::class, 'updateStatus'])
            ->name('orders.status');
        Route::get('/orders/statistics', [App\Http\Controllers\Admin\Ecommerce\OrderController::class, 'statistics'])
            ->name('orders.statistics');
        Route::get('/orders/search', [App\Http\Controllers\Admin\Ecommerce\OrderController::class, 'search'])
            ->name('orders.search');

        // Tags
        Route::get('/tags', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'index'])
            ->name('tags.index');
        Route::get('/tags/create', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'create'])
            ->name('tags.create');
        Route::post('/tags', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'store'])
            ->name('tags.store');
        Route::get('/tags/{tag}', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'show'])
            ->name('tags.show');
        Route::get('/tags/{tag}/edit', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'edit'])
            ->name('tags.edit');
        Route::put('/tags/{tag}', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'update'])
            ->name('tags.update');
        Route::delete('/tags/{tag}', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'destroy'])
            ->name('tags.destroy');
        Route::get('/tags/search', [App\Http\Controllers\Admin\Ecommerce\TagController::class, 'search'])
            ->name('tags.search');

        // Reviews
        Route::get('/reviews', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'index'])
            ->name('reviews.index');
        Route::get('/reviews/pending', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'pending'])
            ->name('reviews.pending');
        Route::get('/reviews/approved', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'approved'])
            ->name('reviews.approved');
        Route::get('/reviews/{review}', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'show'])
            ->name('reviews.show');
        Route::put('/reviews/{review}', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'update'])
            ->name('reviews.update');
        Route::post('/reviews/{review}/approve', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'approve'])
            ->name('reviews.approve');
        Route::post('/reviews/{review}/reject', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'reject'])
            ->name('reviews.reject');
        Route::delete('/reviews/{review}', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'destroy'])
            ->name('reviews.destroy');
        Route::get('/reviews/statistics', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'statistics'])
            ->name('reviews.statistics');
        Route::get('/reviews/search', [App\Http\Controllers\Admin\Ecommerce\ReviewController::class, 'search'])
            ->name('reviews.search');

        // Coupons
        Route::get('/coupons', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'index'])
            ->name('coupons.index');
        Route::get('/coupons/create', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'create'])
            ->name('coupons.create');
        Route::post('/coupons', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'store'])
            ->name('coupons.store');
        Route::get('/coupons/{coupon}', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'show'])
            ->name('coupons.show');
        Route::get('/coupons/{coupon}/edit', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'edit'])
            ->name('coupons.edit');
        Route::put('/coupons/{coupon}', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'update'])
            ->name('coupons.update');
        Route::delete('/coupons/{coupon}', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'destroy'])
            ->name('coupons.destroy');
        Route::post('/coupons/{coupon}/toggle-status', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'toggleStatus'])
            ->name('coupons.toggle-status');
        Route::get('/coupons/search', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'search'])
            ->name('coupons.search');
        Route::get('/coupons/statistics', [App\Http\Controllers\Admin\Ecommerce\CouponController::class, 'statistics'])
            ->name('coupons.statistics');

        // Customers
        Route::get('/customers', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'index'])
            ->name('customers.index');
        Route::get('/customers/create', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'create'])
            ->name('customers.create');
        Route::post('/customers', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'store'])
            ->name('customers.store');
        Route::get('/customers/{customer}', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'show'])
            ->name('customers.show');
        Route::put('/customers/{customer}', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'update'])
            ->name('customers.update');
        Route::post('/customers/{customer}/toggle-ban', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'toggleBan'])
            ->name('customers.toggle-ban');
        Route::delete('/customers/{customer}', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'destroy'])
            ->name('customers.destroy');
        Route::get('/customers/statistics', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'statistics'])
            ->name('customers.statistics');
        Route::get('/customers/search', [App\Http\Controllers\Admin\Ecommerce\CustomerController::class, 'search'])
            ->name('customers.search');

        // B2B Management
        Route::get('/b2b', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'index'])
            ->name('b2b.index');
        Route::get('/b2b/create', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'create'])
            ->name('b2b.create');
        Route::post('/b2b', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'store'])
            ->name('b2b.store');
        Route::get('/b2b/{b2b}', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'show'])
            ->name('b2b.show');
        Route::get('/b2b/{b2b}/edit', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'edit'])
            ->name('b2b.edit');
        Route::put('/b2b/{b2b}', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'update'])
            ->name('b2b.update');
        Route::post('/b2b/{b2b}/approve', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'approve'])
            ->name('b2b.approve');
        Route::post('/b2b/{b2b}/reject', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'reject'])
            ->name('b2b.reject');
        Route::post('/b2b/{b2b}/toggle-status', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'toggleStatus'])
            ->name('b2b.toggle-status');
        Route::delete('/b2b/{b2b}', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'destroy'])
            ->name('b2b.destroy');
        Route::get('/b2b/statistics', [App\Http\Controllers\Admin\Ecommerce\B2BController::class, 'statistics'])
            ->name('b2b.statistics');

        // Reports
        Route::get('/reports', [App\Http\Controllers\Admin\Ecommerce\ReportController::class, 'index'])
            ->name('reports.index');
        Route::get('/reports/sales', [App\Http\Controllers\Admin\Ecommerce\ReportController::class, 'sales'])
            ->name('reports.sales');
        Route::get('/reports/inventory', [App\Http\Controllers\Admin\Ecommerce\ReportController::class, 'inventory'])
            ->name('reports.inventory');
        Route::get('/reports/popular-products', [App\Http\Controllers\Admin\Ecommerce\ReportController::class, 'popularProducts'])
            ->name('reports.popular-products');
        Route::get('/reports/revenue', [App\Http\Controllers\Admin\Ecommerce\ReportController::class, 'revenue'])
            ->name('reports.revenue');
        Route::get('/reports/dashboard-summary', [App\Http\Controllers\Admin\Ecommerce\ReportController::class, 'dashboardSummary'])
            ->name('reports.dashboard-summary');

        // Blog Management
        Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])
            ->name('blog.index');
        Route::get('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])
            ->name('blog.create');
        Route::post('/blog', [App\Http\Controllers\Admin\BlogController::class, 'store'])
            ->name('blog.store');
        Route::get('/blog/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'show'])
            ->name('blog.show');
        Route::get('/blog/{blog}/edit', [App\Http\Controllers\Admin\BlogController::class, 'edit'])
            ->name('blog.edit');
        Route::put('/blog/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'update'])
            ->name('blog.update');
        Route::delete('/blog/{blog}', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])
            ->name('blog.destroy');
        Route::post('/blog/{blog}/toggle-status', [App\Http\Controllers\Admin\BlogController::class, 'toggleStatus'])
            ->name('blog.toggle-status');
    });
});

/*
|--------------------------------------------------------------------------
| Role-wise Dashboards (Receptionist, Staff, Visitor all use same controller)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:receptionist|staff|visitor'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Visitor\VisitorController::class, 'dashboard'])
        ->name('dashboard');
});



/*
|--------------------------------------------------------------------------
| Guest pages (guest only)
|--------------------------------------------------------------------------
*/


Route::get('/', function(){
    return view('frontend.pages.home');
})->name('home');



/*
|--------------------------------------------------------------------------
| Auth pages (guest only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);


});

/*
|--------------------------------------------------------------------------
| Frontend E-commerce Routes
|--------------------------------------------------------------------------
*/

// Shop routes
Route::get('/shop', [App\Http\Controllers\Frontend\ShopController::class, 'index'])->name('shop');
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/category/{slug}', [App\Http\Controllers\Frontend\ShopController::class, 'category'])->name('category');
    Route::get('/product/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('product');
});

// Cart routes
Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart');
Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add', [App\Http\Controllers\Frontend\CartController::class, 'add'])->name('add');
    Route::post('/update', [App\Http\Controllers\Frontend\CartController::class, 'update'])->name('update');
    Route::post('/remove', [App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('remove');
});

// Checkout routes
Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout');
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::post('/', [App\Http\Controllers\Frontend\CheckoutController::class, 'store'])->name('store');
});

// Customer routes (requires authentication)
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Frontend\CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [App\Http\Controllers\Frontend\CustomerController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [App\Http\Controllers\Frontend\CustomerController::class, 'orderShow'])->name('orders.show');
    Route::get('/wishlist', [App\Http\Controllers\Frontend\CustomerController::class, 'wishlist'])->name('wishlist');
    Route::get('/addresses', [App\Http\Controllers\Frontend\CustomerController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [App\Http\Controllers\Frontend\CustomerController::class, 'storeAddress'])->name('addresses.store');
    Route::get('/profile', [App\Http\Controllers\Frontend\CustomerController::class, 'profile'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\Frontend\CustomerController::class, 'updateProfile'])->name('profile.update');
});

// Other frontend pages
Route::get('/about', function() { return view('frontend.pages.about'); })->name('about');
Route::get('/contact', function() { return view('frontend.pages.contact'); })->name('contact');
Route::get('/terms', function() { return view('terms'); })->name('terms');
Route::get('/policy', function() { return view('policy'); })->name('policy');

// Search route
Route::get('/search', [App\Http\Controllers\Frontend\SearchController::class, 'index'])->name('search');

// Public Live Dashboard Routes (No authentication required)
Route::get('/public/live-dashboard', [App\Http\Controllers\Visitor\VisitorController::class, 'liveDashboardPublic'])
    ->name('visitor.live.public');

Route::get('/api/visitors/live-public', [App\Http\Controllers\Visitor\VisitorController::class, 'liveVisitorsApiPublic'])
    ->name('api.visitors.live.public');



/*
|--------------------------------------------------------------------------
| Password Reset (ALLOW AUTH + GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [PasswordResetController::class, 'request'])
    ->name('password.request');

Route::post('/forgot-password-email', [PasswordResetController::class, 'email'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'update'])
    ->name('password.update');

// Send reset email to currently authenticated user
Route::post('/profile/send-reset-email', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink($request->only('email'));

    return back()->with('status', $status === Password::RESET_LINK_SENT
        ? __($status)
        : __('Failed to send reset link. ' . __($status)));
})->name('profile.send-reset-email');


/*
|--------------------------------------------------------------------------
| Authenticated pages
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Test email route
Route::get('/test-mail', function() {
    try {
        Mail::raw('This is a test email from Laravel', function($message) {
            $message->to('ashrafulunisoft@gmail.com')
                    ->subject('Test Email');
        });
        return 'Email sent successfully! Check your inbox.';
    } catch (\Exception $e) {
        return 'Error sending email: ' . $e->getMessage();
    }
});

// Visitor CSV Export Routes (Public for testing)
Route::get('/visitors/export/preview', [VisitorExportController::class, 'previewVisitorData'])
    ->name('visitors.export.preview');

Route::get('/visitors/export/send', [VisitorExportController::class, 'sendVisitorCsv'])
    ->name('visitors.export.send');


//---------------------------------------------------------------------------

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});




// Test notification route
Route::get('/test-notification', function () {
    $visitor = \App\Models\Visitor::first();

    if (!$visitor) {
        return 'No visitor found in database. Create a visitor first.';
    }

    // Test email
    try {
        $visitor->notify(new \App\Notifications\VisitorRegistered($visitor, $visitor->visits()->first()));
        return 'Email notification sent successfully! Check your inbox.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->name('test.notification');

// Test visitor registration email with EmailNotificationService
Route::get('/test-visitor-email', function () {
    $emailService = new \App\Services\EmailNotificationService();

    $emailData = [
        'visitor_name' => 'Test Visitor',
        'visitor_email' => 'ashrafulunisoft@gmail.com',
        'visitor_phone' => '+8801234567890',
        'visitor_company' => 'Test Company',
        'visit_date' => 'January 25, 2026 - 2:30 PM',
        'visit_type' => 'Business Meeting',
        'purpose' => 'Testing email notification service',
        'host_name' => 'Test Host',
        'status' => 'approved',
    ];

    try {
        $result = $emailService->sendVisitorRegistrationEmail($emailData);
        return $result
            ? '✅ Visitor registration email sent successfully! Check ashrafulunisoft@gmail.com'
            : '❌ Failed to send email. Check logs for details.';
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
})->name('test.visitor.email');

// -------------------------------------------------------------------------
// Visitor Management Routes (with permission middleware)
Route::middleware(['auth'])->group(function () {
    // Specific static routes MUST come before dynamic routes
    Route::get('/visitor/pending', [App\Http\Controllers\Visitor\VisitorController::class, 'pendingVisits'])->name('visitor.pending');
    Route::get('/visitor/rejected', [App\Http\Controllers\Visitor\VisitorController::class, 'rejectedVisits'])->name('visitor.rejected');
    Route::get('/visitor/approved', [App\Http\Controllers\Visitor\VisitorController::class, 'approvedVisits'])->name('visitor.approved');
    Route::get('/visitor/history', [App\Http\Controllers\Visitor\VisitorController::class, 'visitHistory'])->name('visitor.history');
    Route::get('/visitor/active', [App\Http\Controllers\Visitor\VisitorController::class, 'activeVisits'])->name('visitor.active');
    Route::get('/visitor/checkin-checkout', [App\Http\Controllers\Visitor\VisitorController::class, 'checkinCheckout'])->name('visitor.checkin-checkout');

    // API routes
    Route::get('/visitor/autofill', [App\Http\Controllers\Visitor\VisitorController::class, 'autofill'])->name('visitor.autofill');
    Route::get('/visitor/check-email', [App\Http\Controllers\Visitor\VisitorController::class, 'checkVisitorByEmail'])->name('visitor.check-email');
    Route::get('/visitor/check-phone', [App\Http\Controllers\Visitor\VisitorController::class, 'checkVisitorByPhone'])->name('visitor.check-phone');
    Route::get('/visitor/search-host', [App\Http\Controllers\Visitor\VisitorController::class, 'searchHost'])->name('visitor.search-host');
    Route::get('/visitor/search-phone', [App\Http\Controllers\Visitor\VisitorController::class, 'searchVisitorByPhone'])->name('visitor.search-phone');
    Route::get('/visitor/statistics', [App\Http\Controllers\Visitor\VisitorController::class, 'statistics'])->name('visitor.statistics');
    Route::get('/visitor/report', [App\Http\Controllers\Visitor\VisitorController::class, 'report'])->name('visitor.report');
    Route::get('/visitor/report/export-csv', [App\Http\Controllers\Visitor\VisitorController::class, 'exportReportCsv'])->name('visitor.report.export-csv');

    // CRUD routes (dynamic routes MUST come last)
    Route::get('/visitor', [App\Http\Controllers\Visitor\VisitorController::class, 'index'])->name('visitor.index');
    Route::get('/visitor/create', [App\Http\Controllers\Visitor\VisitorController::class, 'create'])->name('visitor.create');
    Route::post('/visitor', [App\Http\Controllers\Visitor\VisitorController::class, 'store'])->name('visitor.store');
    Route::get('/visitor/{id}', [App\Http\Controllers\Visitor\VisitorController::class, 'show'])->name('visitor.show');
    Route::get('/visitor/{id}/edit', [App\Http\Controllers\Visitor\VisitorController::class, 'edit'])->name('visitor.edit');
    Route::put('/visitor/{id}', [App\Http\Controllers\Visitor\VisitorController::class, 'update'])->name('visitor.update');
    Route::delete('/visitor/{id}', [App\Http\Controllers\Visitor\VisitorController::class, 'destroy'])->name('visitor.destroy');

    // OTP Verification Routes
    Route::middleware('permission:verify visit otp')->group(function () {
        Route::get('/visitor/{id}/verify-otp', [App\Http\Controllers\Visitor\VisitorController::class, 'showVerifyOtp'])->name('visitor.verify.otp.view');
        Route::post('/visitor/verify-otp/{id}', [App\Http\Controllers\Visitor\VisitorController::class, 'verifyOtp'])->name('visitor.verify.otp');
    });

    // Host Approval Routes
    Route::post('/visits/{id}/approve', [App\Http\Controllers\Visitor\VisitorController::class, 'approveVisit'])
        ->name('visit.approve')
        ->middleware(['auth', 'permission:approve visit']);

    Route::post('/visits/{id}/reject', [App\Http\Controllers\Visitor\VisitorController::class, 'rejectVisit'])
        ->name('visit.reject')
        ->middleware(['auth', 'permission:reject visit']);

    // Check-in/Check-out Routes
    Route::middleware('permission:checkin visit')->group(function () {
        Route::post('/visits/{id}/check-in', [App\Http\Controllers\Visitor\VisitorController::class, 'checkIn'])->name('visit.checkin');
    });

    Route::middleware('permission:checkout visit')->group(function () {
        Route::post('/visits/{id}/check-out', [App\Http\Controllers\Visitor\VisitorController::class, 'checkOut'])->name('visit.checkout');
    });

    // Live Dashboard Routes
    Route::middleware('permission:view live dashboard')->group(function () {
        Route::get('/visitors/live-dashboard', [App\Http\Controllers\Visitor\VisitorController::class, 'liveDashboard'])->name('visitor.live');
    });

    // API Routes (no authentication for public access if needed)
    Route::get('/api/visitors/live', [App\Http\Controllers\Visitor\VisitorController::class, 'liveVisitorsApi'])->name('api.visitors.live');
});

// -------------------------------------------------------------------------
// Test SMS route
Route::get('/test-sms', function () {
    $smsService = new \App\Services\SmsNotificationService();

    $phone = '8801859385787'; // Test phone number (format: 880XXXXXXXXXX)
    $message = 'This is a test SMS from VMS UCBL system. If you receive this, SMS is working!';

    try {
        $result = $smsService->send($phone, $message);

        if ($result['success']) {
            return '✅ SMS sent successfully to ' . $phone . '! Check your phone.';
        } else {
            return '❌ Failed to send SMS: ' . $result['message'];
        }
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
})->name('test.sms');

    // API Routes (no authentication for public access if needed)
    Route::get('/api/visitors/live', [App\Http\Controllers\Visitor\VisitorController::class, 'liveVisitorsApi'])->name('api.visitors.live');

    // API Routes for host pending visits (with permission check)
    Route::middleware(['auth', 'permission:approve visit'])->group(function () {
        Route::get('/api/host-pending-visits', [App\Http\Controllers\Visitor\VisitorController::class, 'hostPendingVisitsApi'])->name('api.host.pending.visits');
    });

    // -------------------------------------------------------------------------
    // Route::middleware([
    //     'auth:sanctum',
    //     config('jetstream.auth_session'),
    //     'verified',
    // ])->group(function () {
    //     Route::get('/dashboard', function () {
    //         return view('dashboard');
    //     })->name('dashboard');
    // });
