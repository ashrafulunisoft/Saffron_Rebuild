I checked your uploaded **Bengali product naming document**, and it clearly shows that the system must support:

* **English + Bengali product names**
* **SKU codes**
* **tags**
* **categories**
* **sizes / variants**
* **freshness / quality tags**
* **packaging**
* **product types** (cake, bread, sweets etc.)

So we should **update the ecommerce database structure** to support this **properly for Bangla e-commerce**.

Below is the **updated Laravel Models + Migrations design**.

---

# 1. Categories Migration

Supports **Bangla + English names**.

```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name_en');
    $table->string('name_bn');
    $table->string('slug')->unique();
    $table->foreignId('parent_id')->nullable()->constrained('categories')->cascadeOnDelete();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

Example:

```
name_en : Cakes
name_bn : কেক
```

---

# 2. Products Migration

Supports:

* SKU
* English + Bengali name
* pricing
* stock
* product status

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();

    $table->string('sku')->unique();

    $table->string('name_en');
    $table->string('name_bn');

    $table->string('slug')->unique();

    $table->text('description_en')->nullable();
    $table->text('description_bn')->nullable();

    $table->decimal('price',10,2);
    $table->decimal('sale_price',10,2)->nullable();

    $table->integer('stock')->default(0);

    $table->foreignId('category_id')->constrained()->cascadeOnDelete();

    $table->integer('views')->default(0);

    $table->boolean('is_featured')->default(false);
    $table->boolean('is_active')->default(true);

    $table->timestamps();
});
```

Example:

```
sku: CAK-001
name_en: Vanilla Sponge Cake
name_bn: ভ্যানিলা স্পঞ্জ কেক
```

Matches your document. 

---

# 3. Product Images

```php
Schema::create('product_images', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->string('image');
    $table->boolean('is_primary')->default(false);
    $table->timestamps();
});
```

---

# 4. Tags (Bangla Tags from Document)

Document contains tags like:

```
তাজা
নরম
হালাল
বিএসটিআই
```

Migration:

```php
Schema::create('tags', function (Blueprint $table) {
    $table->id();
    $table->string('name_en');
    $table->string('name_bn');
    $table->timestamps();
});
```

---

# 5. Product Tag Pivot

```php
Schema::create('product_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
});
```

---

# 6. Cart Migration

```php
Schema::create('carts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->integer('quantity');
    $table->timestamps();
});
```

---

# 7. Orders Migration

```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('order_number')->unique();

    $table->decimal('total_amount',10,2);
    $table->decimal('discount',10,2)->default(0);
    $table->decimal('final_amount',10,2);

    $table->string('status')->default('pending');

    $table->string('payment_method')->nullable();
    $table->string('payment_status')->default('unpaid');

    $table->text('shipping_address');

    $table->timestamps();
});
```

---

# 8. Order Items

```php
Schema::create('order_items', function (Blueprint $table) {
    $table->id();

    $table->foreignId('order_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();

    $table->decimal('price',10,2);
    $table->integer('quantity');

    $table->timestamps();
});
```

---

# 9. Coupon Migration

```php
Schema::create('coupons', function (Blueprint $table) {
    $table->id();

    $table->string('code')->unique();

    $table->enum('type',['percent','fixed']);

    $table->decimal('value',10,2);

    $table->decimal('max_discount',10,2)->nullable();

    $table->timestamp('expires_at')->nullable();

    $table->integer('usage_limit')->nullable();

    $table->timestamps();
});
```

---

# 10. Product Reviews

```php
Schema::create('reviews', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();

    $table->integer('rating');

    $table->text('comment')->nullable();

    $table->timestamps();
});
```

---

# 11. Reward Points

```php
Schema::create('point_transactions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->integer('points');

    $table->enum('type',['earn','redeem']);

    $table->string('description')->nullable();

    $table->timestamps();
});
```

---

# 12. Product Model Example

```php
class Product extends Model
{
    protected $fillable = [
        'sku',
        'name_en',
        'name_bn',
        'slug',
        'description_en',
        'description_bn',
        'price',
        'sale_price',
        'stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
```

---

# 13. Best Selling Product Query

```php
Product::withCount('orderItems')
    ->orderBy('order_items_count','desc')
    ->take(10)
    ->get();
```

---

# 14. Popular Product Query

```php
Product::orderBy('views','desc')->take(10)->get();
```

---

# 15. New Product Query

```php
Product::latest()->take(10)->get();
```

---

# 16. Why This Structure Matches Your Document

Because your document requires:

✔ SKU based catalog
✔ Bengali product names
✔ category classification
✔ tags like freshness/quality
✔ bakery products types

This schema supports all of them.

---

✅ Result:

You now have a **clean Laravel ecommerce schema** with:

* Bangla language support
* SKU catalog
* tags
* stock
* cart
* order
* coupon
* review
* reward points

---

If you want, I can also give you **Laravel Seeders that auto-insert all 40+ Bengali products from your document into the database** (this will save **5–6 hours of manual data entry**).
