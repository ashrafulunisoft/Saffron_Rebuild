# ✅ Admin User Setup Complete

## Date: 2026-03-11

---

## Admin User Credentials

| Field | Value |
|-------|-------|
| **Email** | `amshuvo64@gmail.com` |
| **Password** | `786Shuvo` |
| **Name** | Admin User |
| **Role** | admin |
| **User ID** | 1 |

---

## Login Information

**Login URL:** `http://your-domain/login`

### Step-by-Step Login Process:

1. **Go to:** `/login`
2. **Enter Email:** `amshuvo64@gmail.com`
3. **Enter Password:** `786Shuvo`
4. **Click:** Login button
5. **Redirect:** You will be automatically redirected to `/admin/dashboard`

---

## Role & Permissions

### Role: `admin`

The admin user has been assigned the `admin` role using Spatie Laravel Permission package.

**Capabilities:**
- ✅ Full access to admin dashboard
- ✅ Manage all users
- ✅ Manage visitor management system
- ✅ Manage ecommerce products, orders, categories
- ✅ Access all admin features
- ✅ View reports and statistics

---

## Admin Dashboard Access

After logging in, the admin user can access:

### Visitor Management System (Existing)
- `/admin/dashboard` - Main admin dashboard
- `/admin/visitor` - Visitor management
- `/admin/visitor/pending` - Pending visits
- `/admin/visitor/approved` - Approved visits
- `/admin/visitor/history` - Visit history
- `/admin/visitor/active` - Active visits
- `/admin/visitor/checkin-checkout` - Check-in/Check-out

### Ecommerce System (To Be Built)
- `/admin/ecommerce/dashboard` - Ecommerce dashboard
- `/admin/ecommerce/products` - Product management
- `/admin/ecommerce/orders` - Order management
- `/admin/ecommerce/categories` - Category management
- `/admin/ecommerce/coupons` - Coupon management
- `/admin/ecommerce/reports` - Sales reports

---

## Security Notes

### Password Security
- Password is hashed using Laravel's bcrypt
- Never store plain text passwords
- Password strength: Medium (alphanumeric with mixed case)

### Recommended Actions
1. ✅ Change password after first login
2. ✅ Enable two-factor authentication (if available)
3. ✅ Use strong password (12+ characters with symbols)
4. ✅ Regular password updates (every 90 days)
5. ✅ Limit login attempts (already configured in Laravel)

---

## User Management

### Create Additional Admins
To create more admin users, use tinker:

```bash
php artisan tinker
```

```php
$user = App\Models\User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
]);
$user->assignRole('admin');
```

### Create Staff Users
For staff with limited access:

```php
$user = App\Models\User::create([
    'name' => 'Staff Name',
    'email' => 'staff@example.com',
    'password' => bcrypt('password'),
]);
$user->assignRole('staff');
```

### Create Regular Users
For customers/shoppers:

```php
$user = App\Models\User::create([
    'name' => 'Customer Name',
    'email' => 'customer@example.com',
    'password' => bcrypt('password'),
]);
// No role needed for regular customers
```

---

## Troubleshooting

### Issue: Cannot Login
**Solutions:**
1. Check email is correct: `amshuvo64@gmail.com`
2. Check password is correct: `786Shuvo`
3. Clear browser cache
4. Run: `php artisan config:clear`
5. Run: `php artisan cache:clear`

### Issue: Redirected to Wrong Dashboard
**Solution:**
- Check middleware in `app/Http/Middleware/RoleRedirect.php`
- Verify role-based redirection logic

### Issue: 403 Forbidden
**Solutions:**
1. Verify user has admin role
2. Check route permissions
3. Clear application cache: `php artisan cache:clear`

### Issue: Session Expired
**Solutions:**
1. Run: `php artisan config:clear`
2. Run: `php artisan session:table`
3. Run: `php artisan migrate`
4. Check session lifetime in `config/session.php`

---

## Database Records

### users_table
```sql
SELECT * FROM users WHERE email = 'amshuvo64@gmail.com';
```

**Result:**
| id | name | email | created_at | updated_at |
|----|------|-------|------------|------------|
| 1 | Admin User | amshuvo64@gmail.com | 2026-03-11 06:07:25 | 2026-03-11 06:07:36 |

### roles_table
```sql
SELECT * FROM roles WHERE name = 'admin';
```

**Result:**
| id | name | guard_name | created_at | updated_at |
|----|------|------------|------------|------------|
| 1 | admin | web | 2026-03-11 06:07:25 | 2026-03-11 06:07:25 |

### model_has_roles_table
```sql
SELECT * FROM model_has_roles WHERE model_id = 1;
```

**Result:**
| id | role_id | model_type | model_id |
|----|---------|------------|----------|
| 1 | 1 | App\Models\User | 1 |

---

## Quick Commands

### Check Admin User
```bash
php artisan tinker
>>> $admin = User::where('email', 'amshuvo64@gmail.com')->first();
>>> $admin->hasRole('admin'); // Should return true
>>> $admin->getRoleNames(); // Should return ["admin"]
```

### Reset Admin Password
```bash
php artisan tinker
>>> $user = User::where('email', 'amshuvo64@gmail.com')->first();
>>> $user->password = bcrypt('new_password');
>>> $user->save();
```

### Add Permission to Admin
```bash
php artisan tinker
>>> $admin = User::where('email', 'amshuvo64@gmail.com')->first();
>>> $admin->givePermissionTo('edit products');
```

### Remove Role from User
```bash
php artisan tinker
>>> $user = User::find(1);
>>> $user->removeRole('admin');
```

---

## Summary

✅ **Admin user created successfully**
✅ **Role assigned: admin**
✅ **Email: amshuvo64@gmail.com**
✅ **Password: 786Shuvo**
✅ **Ready to login at: /login**
✅ **Redirects to: /admin/dashboard**

---

## Next Steps

1. **Login** to admin dashboard
2. **Verify** all features work
3. **Change** password (recommended)
4. **Start building** ecommerce features:
   - Shop controllers
   - Admin ecommerce controllers
   - Product management
   - Order management
   - Category management
   - Reports & analytics

---

*Setup completed: 2026-03-11*
*Laravel: 11.x*
*Package: Spatie Laravel Permission*
