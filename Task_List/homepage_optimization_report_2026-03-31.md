# Homepage Performance Optimization Report

**Project:** Saffron Sweets & Bakery (VMS-UCBL)
**URL:** http://202.74.246.122:8000/
**Date:** 2026-03-31
**Prepared by:** Md. Ashraful Momen

---

## 1. Executive Summary

The homepage loads in approximately **4.85 seconds** on the live server. After implementing lazy loading and async decoding optimizations, the initial visible content should load faster. The main bottleneck is **5.3 MB of product/blog images** (42 PNG files) that the browser must download.

---

## 2. Server-Side Performance

| Metric | Value | Rating |
|--------|-------|--------|
| DNS Lookup | 0.000s (local) | Excellent |
| TCP Connect | 0.002s | Excellent |
| TTFB (Time to First Byte) | 0.063s (63ms) | Excellent |
| HTML Response Size | 219 KB | Needs improvement |
| HTTP Response Total | 0.081s (81ms) | Excellent |
| Server Software | PHP 8.4.16 built-in server | Not production-grade |

**Verdict:** Server-side is fast. TTFB of 63ms is excellent. The server generates and delivers HTML in under 100ms.

---

## 3. Page Resource Breakdown

### 3.1 External CDN Resources

| Resource | Size | Load Time | Cached by CDN |
|----------|------|-----------|---------------|
| Google Fonts (Playfair Display + Poppins) | 2 KB (CSS) | 290ms | Yes |
| Bootstrap 5.3.2 CSS | 233 KB | 89ms | Yes |
| Font Awesome 6.5.0 | 103 KB | 58ms | Yes |
| Animate.css 4.1.1 | 72 KB | 62ms | Yes |
| Bootstrap 5.3.2 JS Bundle | 81 KB | 80ms | Yes |
| **CDN Total** | **~491 KB** | **~580ms** | **Yes** |

### 3.2 Inline Resources (embedded in HTML)

| Resource | Size |
|----------|------|
| Inline CSS (4 blocks) | 73.7 KB |
| Inline JS (5 blocks) | 22.2 KB |
| **Inline Total** | **~96 KB** |

### 3.3 Product & Blog Images (Local Server)

| Category | Count | Total Size |
|----------|-------|------------|
| Featured Products | 8 images | ~1.1 MB |
| New Arrivals | 8 images | ~1.1 MB |
| Best Sellers | 8 images | ~1.1 MB |
| Blog Posts | 3 images | ~376 KB |
| Duplicate Images (shared across sections) | 15 additional requests | N/A |
| **Total Unique Images** | **39 unique** | **~5.3 MB** |

**Average image size:** 143 KB per PNG file

---

## 4. Issues Identified

### Critical Issues

| # | Issue | Impact | Status |
|---|-------|--------|--------|
| 1 | **No browser caching headers** - Server sends `Cache-Control: no-cache, private` on all responses | Repeat visitors re-download everything | Needs server fix |
| 2 | **No gzip/brotli compression** - HTML responses not compressed | 219 KB HTML sent uncompressed (could be ~40 KB with gzip) | Needs server fix |
| 3 | **PHP built-in server** (`php artisan serve`) in production | Single-threaded, no caching, no compression | Needs Nginx/Apache |
| 4 | **5.3 MB total image payload** | Main cause of 4.85s load time | Partially fixed (lazy loading) |

### Medium Priority Issues

| # | Issue | Impact |
|---|-------|--------|
| 5 | **73.7 KB inline CSS** embedded in HTML | Increases HTML size, not cached separately |
| 6 | **42 image requests** (including duplicates) | HTTP connection overhead |
| 7 | **Duplicate image requests** - Same product image loaded in multiple sections | Wasted bandwidth |

---

## 5. Optimizations Implemented (2026-03-31)

### 5.1 Lazy Loading (DEPLOYED)

Added `loading="lazy"` and `decoding="async"` to all 42 product and blog images on the homepage.

**Files modified:**
- `resources/views/frontend/pages/home.blade.php` (4 img tags)
- `resources/views/frontend/partials/product-card.blade.php` (1 img tag)

**Effect:**
- Only visible images load on initial page render (~8-12 images)
- Remaining images load as user scrolls down
- Initial network requests reduced from 42 to ~12 images
- **Estimated first-contentful-paint improvement: 50-60%**

### 5.2 Browser Caching Configuration (ADDED but NOT ACTIVE)

Added caching rules to `public/.htaccess`:
- Images: 1 month cache
- CSS/JS: 1 week cache
- Gzip compression for text-based resources

**Note:** The live server uses PHP's built-in server on port 8000, which **ignores .htaccess** files. These rules will only work when the site is served via Apache or Nginx.

---

## 6. Recommendations

### HIGH PRIORITY - Server Infrastructure

#### 6.1 Replace PHP Built-in Server with Nginx
The current setup uses `php artisan serve` which is a development server. For production:

```
Recommended: Nginx + PHP-FPM
Benefits:
- Gzip compression (reduces HTML from 219KB to ~40KB)
- Static file caching headers (images cached 30 days)
- Concurrent request handling
- Significant performance improvement
```

Sample Nginx configuration:
```nginx
server {
    listen 80;
    server_name 202.74.246.122;
    root /path/to/vms-ucbl/public;
    index index.php;

    # Gzip compression
    gzip on;
    gzip_types text/html text/css application/javascript application/json image/svg+xml;
    gzip_min_length 256;

    # Static asset caching
    location ~* \.(png|jpg|jpeg|webp|gif|svg|ico|css|js|woff2)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

#### 6.2 Convert Images to WebP Format
WebP provides 60-80% size reduction over PNG with same visual quality.

```
Current: 5.3 MB (42 PNG images, avg 143 KB each)
Expected with WebP: ~1.5-2.0 MB (avg 40-50 KB each)
Savings: ~3.3-3.8 MB (60-70% reduction)
```

Implementation options:
- **Option A:** Pre-convert all images using ImageMagick (`convert image.png -quality 85 image.webp`)
- **Option B:** Use Laravel to generate WebP on-the-fly with intervention/image package
- **Option C:** Use `<picture>` tag to serve WebP with PNG fallback

### MEDIUM PRIORITY

#### 6.3 Extract Inline CSS to External File
Move the 73.7 KB inline CSS to a separate `.css` file so it can be cached by the browser.

```
Current: 73.7 KB inline CSS loaded with every page request (not cached)
After: External CSS file cached for 30 days, only downloaded once
```

#### 6.4 Implement Image Thumbnail Sizes
Generate smaller thumbnails for product listing pages instead of serving full-size images.

```
Current: Full-size PNG (~143 KB) used for small product cards
Recommended: Generate 300x300 thumbnails (~30-50 KB each)
```

#### 6.5 Add Preload Hints
Add `<link rel="preload">` for critical resources:

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
```

---

## 7. Expected Performance After Full Optimization

| Scenario | Load Time | Improvement |
|----------|-----------|-------------|
| Current (PHP server, PNG, no caching) | 4.85s | Baseline |
| + Lazy loading only (current state) | ~2.5-3.0s | ~40% faster |
| + Nginx + gzip + caching | ~1.5-2.0s | ~60% faster |
| + WebP images + Nginx + caching | ~0.8-1.2s | ~80% faster |
| + All optimizations (thumbnails, extract CSS) | ~0.5-0.8s | ~85% faster |

---

## 8. Quick Win Action Items

| # | Action | Effort | Impact |
|---|--------|--------|--------|
| 1 | Switch to Nginx + PHP-FPM | Medium | Very High |
| 2 | Enable gzip on Nginx | Low | High |
| 3 | Add cache headers on Nginx | Low | High (repeat visits) |
| 4 | Convert PNG to WebP | Medium | Very High |
| 5 | Extract inline CSS | Low | Medium |
| 6 | Generate image thumbnails | Medium | High |
| 7 | Add preload hints | Low | Low-Medium |

---

## 9. Technical Details

### Current Server Stack
- PHP 8.4.16 built-in development server
- Laravel Framework 12.47.0
- No reverse proxy (Nginx/Apache)
- No OPcache verification pending
- No queue workers for background tasks

### Homepage Database Queries
The homepage controller executes 8 optimized queries totaling ~30ms:
- Featured products with category
- New arrivals with category
- Best sellers with category
- Blog posts
- CMS sections
- Categories
- Settings
- Cart count

### Image Storage
- Location: `storage/app/public/products/`
- Total images: 103 product images
- Format: PNG (transparent)
- Total storage: 15 MB
- Average size: ~143 KB per image

---

*Report generated on 2026-03-31*
