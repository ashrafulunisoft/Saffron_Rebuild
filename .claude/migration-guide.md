# Database Migration Guide - Saffron Ecommerce

## Date: 2026-03-11

## Current Status

✅ **Database backup exists at:** `database/backup/saffron_ecommerce.sql`

## Database Structure Analysis

### Existing Tables (from backup):
- ✅ `product_orders` (NOT `orders`)
- ✅ `order_items` with foreign key to `product_orders`
- ✅ `carts`, `categories`, `products`, `product_images`, `tags`
- ✅ `product_tag` (pivot table)
- ✅ `coupons`, `reviews`, `point_transactions`

### Issue Found:
The original migration created `product_orders` table, but Laravel conventions expect `orders` table.

## Solution Implemented

### 1. Safe Migration Created
**File:** `database/migrations/2026_03_11_055333_rename_product_orders_to_orders_table.php`

This migration will:
- Drop the foreign key from `order_items`
- Rename `product_orders` → `orders`
- Re-add foreign key pointing to `orders` table
- **NO DATA LOSS** - All existing data is preserved

### 2. Model Updates

**Order Model** (`app/Models/Order.php`):
```php
protected $table = 'product_orders'; // Temporarily uses existing table
```

**User Model** (`app/Models/User.php`):
```php
public function orders() {
    return $this->hasMany(Order::class); // Works with custom table name
}
```

## Migration Steps (Safe Process)

### Step 1: Verify Current State
```bash
# Check current tables
php artisan tinker
>>> Schema::getTableListing();
// Should show 'product_orders' table
```

### Step 2: Backup Current Database (Already Done!)
```bash
# Your backup is at:
database/backup/saffron_ecommerce.sql
```

### Step 3: Run the Safe Migration
```bash
# This will rename the table WITHOUT data loss
php artisan migrate
```

**What happens internally:**
1. Drops foreign key constraint from `order_items`
2. Renames `product_orders` → `orders`
3. Re-adds foreign key to `orders` table
4. All data preserved!

### Step 4: Update Order Model
After migration runs, update `app/Models/Order.php`:

**Remove this line:**
```php
protected $table = 'product_orders';
```

**Why:** After migration, the table will be named `orders`, so Laravel conventions work.

### Step 5: Verify Everything Works
```bash
php artisan tinker

# Test relationships
$user = App\Models\User::first();
$user->orders()->count(); // Should return order count

$order = App\Models\Order::first();
$order->orderItems()->count(); // Should return items count

// Check table exists
Schema::hasTable('orders'); // Should return true
Schema::hasTable('product_orders'); // Should return false
```

## Rollback Plan (If Needed)

If something goes wrong, you can rollback:

```bash
# Rollback the rename migration
php artisan migrate:rollback --step=1

# This will:
# 1. Drop foreign key from order_items
# 2. Rename 'orders' → 'product_orders'
# 3. Re-add foreign key to 'product_orders'

# Then restore from backup if needed
mysql -u root -p vmsucbl_db_2 < database/backup/saffron_ecommerce.sql
```

## Never Use These Commands ⚠️

```bash
# ❌ NEVER RUN - This deletes ALL data
php artisan migrate:fresh

# ❌ NEVER RUN - This also deletes ALL data
php artisan migrate:refresh

# ❌ NEVER RUN - This drops and recreates all tables
php artisan db:wipe
```

## Safe Commands ✅

```bash
# ✅ Safe - Run new migrations
php artisan migrate

# ✅ Safe - Rollback last migration
php artisan migrate:rollback

# ✅ Safe - Rollback specific number of migrations
php artisan migrate:rollback --step=1

# ✅ Safe - Show migration status
php artisan migrate:status

# ✅ Safe - Check pending migrations
php artisan migrate:status | grep "Not found"
```

## Migration Files Status

### Original Migrations (Already Run - Batch 1 & 2):
1. ✅ `2026_03_10_100001_create_categories_table`
2. ✅ `2026_03_10_100002_create_products_table`
3. ✅ `2026_03_10_100003_create_product_images_table`
4. ✅ `2026_03_10_100004_create_tags_table`
5. ✅ `2026_03_10_100005_create_product_tag_table`
6. ✅ `2026_03_10_100006_create_carts_table`
7. ✅ `2026_03_10_100007_create_orders_table` (Creates `product_orders`)
8. ✅ `2026_03_10_100008_create_order_items_table`
9. ✅ `2026_03_10_100009_create_coupons_table`
10. ✅ `2026_03_10_100010_create_reviews_table`
11. ✅ `2026_03_10_100011_create_point_transactions_table`

### New Migration (Pending):
12. ⏳ `2026_03_11_055333_rename_product_orders_to_orders_table` (READY TO RUN)

## Foreign Key Relationships After Migration

```sql
-- order_items table
ALTER TABLE `order_items`
ADD CONSTRAINT `order_items_order_id_foreign`
FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

-- products table (already correct)
ALTER TABLE `products`
ADD CONSTRAINT `products_category_id_foreign`
FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

-- carts table (already correct)
ALTER TABLE `carts`
ADD CONSTRAINT `carts_user_id_foreign`
FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

ALTER TABLE `carts`
ADD CONSTRAINT `carts_product_id_foreign`
FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

-- orders table (already correct)
ALTER TABLE `orders` -- will be renamed from product_orders
ADD CONSTRAINT `orders_user_id_foreign`
FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- Other tables already have correct foreign keys
```

## Testing Checklist

After running the migration, test these:

- [ ] Users can access their orders
- [ ] Order items load correctly
- [ ] Cart functionality works
- [ ] Products can be added to orders
- [ ] Categories load products correctly
- [ ] Tags relationship works
- [ ] Reviews can be created
- [ ] Point transactions work
- [ ] Coupons can be applied

## Common Issues & Solutions

### Issue 1: "Table not found: product_orders"
**Solution:** Run the rename migration: `php artisan migrate`

### Issue 2: "Foreign key constraint fails"
**Solution:** The migration handles this automatically by dropping/recreating FKs

### Issue 3: Model still uses old table name
**Solution:** Remove `protected $table = 'product_orders';` from Order model

### Issue 4: Migration won't run
**Solution:** Check `migrations` table to ensure it's not already recorded:
```sql
SELECT * FROM migrations WHERE migration LIKE '%rename_product_orders%';
```

## Next Steps After Migration

1. **Test all relationships** using tinker
2. **Create seeders** for categories, tags, and products
3. **Build controllers** for shop and admin
4. **Create views** for frontend
5. **Implement cart logic**
6. **Build checkout process**

## Support

If you encounter any issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check MySQL logs if needed
3. Use tinker to test relationships: `php artisan tinker`
4. Rollback if needed: `php artisan migrate:rollback --step=1`
5. Restore from backup as last resort

---

## Summary

✅ **Backup exists:** `database/backup/saffron_ecommerce.sql`
✅ **Safe migration created:** Renames table without data loss
✅ **Models updated:** Ready for migration
✅ **Rollback plan:** Can revert changes if needed
✅ **NEVER use migrate:fresh** - Would lose all data

**Ready to run:** `php artisan migrate`
