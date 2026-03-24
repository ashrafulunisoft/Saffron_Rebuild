# PHP Upload Configuration Fix

## Problem
Blog and product image uploads are failing because PHP's default upload limits are too low (2MB).

## Current Settings
```
upload_max_filesize = 2M
post_max_size = 8M
```

## Required Settings
```
upload_max_filesize = 10M
post_max_size = 20M
memory_limit = 256M
```

---

## Solution Options

### Option 1: Quick Fix (Requires sudo)

Run the provided setup script:
```bash
sudo bash setup-php.sh
```

Then restart your PHP server:
```bash
# Stop current server (Ctrl+C)
php artisan serve
```

---

### Option 2: Manual Configuration

#### Step 1: Copy the custom ini file
```bash
sudo cp 99-saffron-uploads.ini /etc/php/8.4/cli/conf.d/
```

#### Step 2: Verify the configuration
```bash
php -i | grep -E "upload_max_filesize|post_max_size"
```

You should see:
```
upload_max_filesize => 10M => 10M
post_max_size => 20M => 20M
```

#### Step 3: Restart your PHP server
```bash
# Stop current server (Ctrl+C)
php artisan serve
```

---

### Option 3: Edit php.ini Directly

#### Step 1: Backup the original file
```bash
sudo cp /etc/php/8.4/cli/php.ini /etc/php/8.4/cli/php.ini.backup
```

#### Step 2: Edit php.ini
```bash
sudo nano /etc/php/8.4/cli/php.ini
```

Find and update these lines:
```ini
upload_max_filesize = 10M
post_max_size = 20M
memory_limit = 256M
max_execution_time = 300
max_input_time = 300
```

#### Step 3: Save and restart
Press `Ctrl+X`, then `Y`, then `Enter`

Restart your PHP server:
```bash
# Stop current server (Ctrl+C)
php artisan serve
```

---

## Verify the Fix

After applying any solution, verify the configuration:

```bash
php -i | grep -E "upload_max_filesize|post_max_size|memory_limit"
```

Expected output:
```
upload_max_filesize => 10M => 10M
post_max_size => 20M => 20M
memory_limit => 256M => 256M
```

---

## Test Image Upload

1. Go to: http://127.0.0.1:8000/admin/ecommerce/blog/create
2. Try uploading an image up to 5MB
3. The upload should now work successfully

---

## Troubleshooting

### If uploads still fail after fixing:

1. **Check Laravel logs**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Check directory permissions**:
   ```bash
   ls -la public/storage/blog/
   ```
   Should show: `drwxrwxrwx`

3. **Clear Laravel cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

4. **Verify storage link**:
   ```bash
   php artisan storage:link
   ```

---

## Files Created

- ✅ `setup-php.sh` - Automated setup script
- ✅ `99-saffron-uploads.ini` - Custom PHP configuration
- ✅ `public/.user.ini` - Directory-level override (if supported)
- ✅ `php.ini` - Project root override (if supported)

---

## Need Help?

If you're still experiencing issues, check the Laravel logs for detailed error messages:
```bash
tail -100 storage/logs/laravel.log
```
