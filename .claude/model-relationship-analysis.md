# Ecommerce Model Relationships Analysis

## Date: 2026-03-11

## Summary
Overall, the ecommerce models are **WELL STRUCTURED** with proper relationships. However, there is **1 CRITICAL ISSUE** that must be fixed.

---

## ❌ CRITICAL ISSUE FOUND

### Orders Table Name Mismatch

**File:** `database/migrations/2026_03_10_100007_create_orders_table.php`

**Problem:**
```php
// Line 14: Creates table as 'product_orders'
Schema::create('product_orders', function (Blueprint $table) {

// Line 41: Tries to drop 'orders' (WRONG!)
Schema::dropIfExists('orders');
```

**Expected:**
- The Order model expects table name: `orders`
- The migration creates: `product_orders`
- This will cause Laravel to not find the table!

**Fix Required:**
Change line 14 from:
```php
Schema::create('product_orders', function (Blueprint $table) {
```
To:
```php
Schema::create('orders', function (Blueprint $table) {
```

Also change line 41 to match (though it already says 'orders'):
```php
Schema::dropIfExists('orders');
```

---

## ✅ CORRECT RELATIONSHIPS

### 1. Category Model ✅
**File:** `app/Models/Category.php`

```php
// Self-referential relationships (parent-child)
public function parent() {
    return $this->belongsTo(Category::class, 'parent_id');
}

public function children() {
    return $this->hasMany(Category::class, 'parent_id');
}

// Products in this category
public function products() {
    return $this->hasMany(Product::class);
}
```
**Status:** ✅ CORRECT

---

### 2. Product Model ✅
**File:** `app/Models/Product.php`

```php
// Belongs to category
public function category() {
    return $this->belongsTo(Category::class);
}

// Has many images
public function images() {
    return $this->hasMany(ProductImage::class);
}

// Belongs to many tags (with pivot)
public function tags() {
    return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
}

// Has many reviews
public function reviews() {
    return $this->hasMany(Review::class);
}

// Has many order items
public function orderItems() {
    return $this->hasMany(OrderItem::class);
}

// Has many cart items
public function carts() {
    return $this->hasMany(Cart::class);
}
```
**Status:** ✅ CORRECT - All relationships properly defined

---

### 3. ProductImage Model ✅
**File:** `app/Models/ProductImage.php`

```php
// Belongs to product
public function product() {
    return $this->belongsTo(Product::class);
}
```
**Status:** ✅ CORRECT

---

### 4. Tag Model ✅
**File:** `app/Models/Tag.php`

```php
// Belongs to many products
public function products() {
    return $this->belongsToMany(Product::class, 'product_tag', 'tag_id', 'product_id');
}
```
**Status:** ✅ CORRECT - Pivot table properly specified

---

### 5. Cart Model ✅
**File:** `app/Models/Cart.php`

```php
// Belongs to user
public function user() {
    return $this->belongsTo(User::class);
}

// Belongs to product
public function product() {
    return $this->belongsTo(Product::class);
}

// Accessor: Calculate subtotal
public function getSubtotalAttribute() {
    $price = $this->product->sale_price ?? $this->product->price;
    return $price * $this->quantity;
}
```
**Status:** ✅ CORRECT

---

### 6. Order Model ✅
**File:** `app/Models/Order.php`

```php
// Belongs to user
public function user() {
    return $this->belongsTo(User::class);
}

// Has many order items
public function orderItems() {
    return $this->hasMany(OrderItem::class);
}

// Scopes
public function scopePending($query) {
    return $query->where('status', 'pending');
}

public function scopeCompleted($query) {
    return $query->where('status', 'completed');
}

// Helper method
public function isPaid() {
    return $this->payment_status === 'paid';
}
```
**Status:** ✅ CORRECT

---

### 7. OrderItem Model ✅
**File:** `app/Models/OrderItem.php`

```php
// Belongs to order
public function order() {
    return $this->belongsTo(Order::class);
}

// Belongs to product
public function product() {
    return $this->belongsTo(Product::class);
}

// Accessor: Calculate subtotal
public function getSubtotalAttribute() {
    return $this->price * $this->quantity;
}
```
**Status:** ✅ CORRECT

---

### 8. Coupon Model ✅
**File:** `app/Models/Coupon.php`

```php
// No relationships needed (standalone model)

// Helper methods
public function isValid() {
    if ($this->expires_at && $this->expires_at->isPast()) {
        return false;
    }
    return true;
}

public function isPercentage() {
    return $this->type === 'percent';
}

public function calculateDiscount($amount) {
    if ($this->isPercentage()) {
        $discount = ($amount * $this->value) / 100;
        if ($this->max_discount) {
            $discount = min($discount, $this->max_discount);
        }
        return $discount;
    }
    return min($this->value, $amount);
}
```
**Status:** ✅ CORRECT - Good helper methods

---

### 9. Review Model ✅
**File:** `app/Models/Review.php`

```php
// Belongs to user
public function user() {
    return $this->belongsTo(User::class);
}

// Belongs to product
public function product() {
    return $this->belongsTo(Product::class);
}

// Scope
public function scopeWithRating($query, $rating) {
    return $query->where('rating', $rating);
}
```
**Status:** ✅ CORRECT

---

### 10. PointTransaction Model ✅
**File:** `app/Models/PointTransaction.php`

```php
// Belongs to user
public function user() {
    return $this->belongsTo(User::class);
}

// Scopes
public function scopeEarned($query) {
    return $query->where('type', 'earn');
}

public function scopeRedeemed($query) {
    return $query->where('type', 'redeem');
}

// Helper methods
public function isEarn() {
    return $this->type === 'earn';
}

public function isRedeem() {
    return $this->type === 'redeem';
}
```
**Status:** ✅ CORRECT

---

### 11. User Model (Ecommerce Relationships) ✅
**File:** `app/Models/User.php`

```php
// Has many cart items
public function carts() {
    return $this->hasMany(Cart::class);
}

// Has many orders
public function orders() {
    return $this->hasMany(Order::class);
}

// Has many reviews
public function reviews() {
    return $this->hasMany(Review::class);
}

// Has many point transactions
public function pointTransactions() {
    return $this->hasMany(PointTransaction::class);
}

// Accessor: Calculate points balance
public function getPointsBalanceAttribute() {
    $earned = $this->pointTransactions()->where('type', 'earn')->sum('points');
    $redeemed = $this->pointTransactions()->where('type', 'redeem')->sum('points');
    return $earned - $redeemed;
}
```
**Status:** ✅ CORRECT - All ecommerce relationships properly defined

---

## Relationship Diagram

```
User (1) ----< (N) Cart
User (1) ----< (N) Order
User (1) ----< (N) Review
User (1) ----< (N) PointTransaction

Category (1) ----< (N) Product
Category (1) ----< (N) Category (self-referential)

Product (1) ----< (N) ProductImage
Product (1) ----< (N) Cart
Product (N) >< (N) Tag (pivot: product_tag)
Product (1) ----< (N) Review
Product (1) ----< (N) OrderItem

Order (1) ----< (N) OrderItem
Order (N) ----< (1) User

OrderItem (N) ----< (1) Order
OrderItem (N) ----< (1) Product

Coupon (standalone - no direct relationships)
```

---

## Recommendations

### 1. MUST FIX - Orders Migration
Change the table name from `product_orders` to `orders` in the migration file.

### 2. OPTIONAL - Add Unique Constraint to Cart
Consider adding unique constraint on (user_id, product_id) in cart to prevent duplicate items:

```php
$table->unique(['user_id', 'product_id']);
```

### 3. OPTIONAL - Add Unique Constraint to Product-Tag
Prevent duplicate tag assignments:

```php
$table->unique(['product_id', 'tag_id']);
```

### 4. OPTIONAL - Add Coupon Usage Tracking
Consider adding a pivot table to track which coupons were used on which orders:

```php
Schema::create('coupon_order', function (Blueprint $table) {
    $table->id();
    $table->foreignId('coupon_id')->constrained()->cascadeOnDelete();
    $table->foreignId('order_id')->constrained()->cascadeOnDelete();
    $table->decimal('discount_amount', 10, 2);
});
```

### 5. OPTIONAL - Add Wishlist Table
Customers might want to save products for later:

```php
Schema::create('wishlists', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->timestamps();

    $table->unique(['user_id', 'product_id']);
});
```

### 6. OPTIONAL - Add Product Address Relationship
Consider adding shipping addresses to User model:

```php
Schema::create('addresses', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('address_line1');
    $table->string('address_line2')->nullable();
    $table->string('city');
    $table->string('postal_code');
    $table->string('phone');
    $table->boolean('is_default')->default(false);
    $table->timestamps();
});
```

---

## Testing Queries

After fixing the orders migration, test these queries:

```php
// Get user's cart with products
$user->carts()->with('product')->get();

// Get product with category and images
$product->load('category', 'images', 'tags');

// Get order with items and products
$order->load('orderItems.product');

// Get product reviews with user info
$product->reviews()->with('user')->get();

// Calculate user points balance
$user->points_balance; // Accessor

// Get best-selling products
Product::withCount('orderItems')
    ->orderBy('order_items_count', 'desc')
    ->take(10)
    ->get();

// Get user's order history
$user->orders()->with('orderItems.product')->latest()->get();
```

---

## Conclusion

**Overall Status:** 9/10 ✅

All model relationships are correctly defined with proper:
- ✅belongsTo relationships
- ✅hasMany relationships
- ✅belongsToMany relationships with pivot tables
- ✅Scopes for common queries
- ✅Helper methods and accessors

**Only Issue:** The orders migration has wrong table name (`product_orders` instead of `orders`).

**Next Steps:**
1. Fix the orders migration table name
2. Run migrations: `php artisan migrate`
3. Test relationships with sample data
4. Create seeders for categories, tags, and products
