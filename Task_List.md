# Saffron E-commerce Project - Complete Task List

**Project:** Saffron Sweets E-commerce Website  
**Domain:** https://saffronsweets.com.bd  
**Server IP:** 182.160.114.66  
**Date:** April 6, 2026

---

## ✅ Completed Tasks

### 1. Server Setup & Dependencies

#### Docker Installation
```bash
# Install Docker
curl -fsSL https://get.docker.com | sudo sh

# Install Docker Compose
sudo apt-get install -y docker-compose

# Verify installation
docker --version        # Docker version 28.2.2
docker-compose --version # Docker Compose version 1.29.2
```

#### PHP 8.4 & Composer Installation
```bash
# Add PHP repository
sudo add-apt-repository -y ppa:ondrej/php

# Install PHP 8.4 with all required extensions
sudo apt-get install -y php8.4 php8.4-cli php8.4-fpm php8.4-mysql \
    php8.4-redis php8.4-xml php8.4-mbstring php8.4-curl \
    php8.4-zip php8.4-bcmath php8.4-gd php8.4-intl php8.4-sqlite3 php8.4-opcache

# Verify installation
php -v               # PHP 8.4.19
composer --version   # Composer 2.9.5
```

#### PM2 Installation
```bash
# Install PM2 globally
sudo npm install -g pm2

# Verify installation
pm2 --version
```

---

### 2. Database & Services (Docker Compose)

#### docker-compose.yml Configuration
```yaml
services:
  mysql:
    image: mysql:8.0
    container_name: vmsucbl_mysql
    restart: unless-stopped
    environment:
      MYSQL_ROOT_PASSWORD: 786Shuvo
      MYSQL_DATABASE: saffron_db
      MYSQL_USER: admin
      MYSQL_PASSWORD: 786Shuvo
    ports:
      - "3307:3306"
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - vmsucbl_network
    command: --default-authentication-plugin=mysql_native_password

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: vmsucbl_phpmyadmin
    restart: unless-stopped
    depends_on:
      - mysql
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
      PMA_ARBITRARY: 1
      UPLOAD_LIMIT: 256M
    ports:
      - "8080:80"
    networks:
      - vmsucbl_network

  redis:
    image: redis:7-alpine
    container_name: vmsucbl_redis
    restart: unless-stopped
    ports:
      - "6380:6379"
    volumes:
      - redis_data:/data
    networks:
      - vmsucbl_network
    command: redis-server --appendonly yes
```

#### Docker Commands
```bash
cd /home/live_ecommerce/saffron_ecommerce/vms-ucbl

# Start all services
docker-compose up -d

# Check status
docker-compose ps

# Output:
# Name               Command               State    Ports
# vmsucbl_mysql      docker-entrypoint.sh...   Up       0.0.0.0:3307->3306/tcp
# vmsucbl_phpmyadmin /docker-entrypoint.sh...   Up       0.0.0.0:8080->80/tcp
# vmsucbl_redis      docker-entrypoint.sh...   Up       0.0.0.0:6380->6379/tcp
```

---

### 3. Application Configuration

#### .env File Updates
```env
# Updated settings
APP_URL=https://saffronsweets.com.bd
SANCTUM_STATEFUL_DOMAINS=https://saffronsweets.com.bd,www.saffronsweets.com.bd
VITE_HOST=saffronsweets.com.bd

# Database
DB_CONNECTION="mysql"
DB_HOST="127.0.0.1"
DB_PORT="3307"
DB_DATABASE="saffron_db"
DB_USERNAME="admin"
DB_PASSWORD="786Shuvo"

# Redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6380
```

#### Storage Symlink Fix
```bash
# Remove old broken symlink
rm public/storage

# Create new correct symlink
php artisan storage:link

# Verify
ls -la public/storage
# Output: public/storage -> /home/live_ecommerce/saffron_ecommerce/vms-ucbl/storage/app/public
```

#### Laravel Optimization Commands
```bash
cd /home/live_ecommerce/saffron_ecommerce/vms-ucbl

# Install dependencies
composer install --no-interaction

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Fix storage symlink
php artisan storage:link
```

---

### 4. PM2 Process Manager Setup

#### ecosystem.config.cjs
```javascript
module.exports = {
  apps: [{
    name: 'saffron',
    script: 'php',
    args: 'artisan serve --host=127.0.0.1 --port=8000',
    cwd: '/home/live_ecommerce/saffron_ecommerce/vms-ucbl',
    interpreter: 'none',
    watch: false,
    autorestart: true,
    max_restarts: 10,
    restart_delay: 1000
  }]
};
```

#### PM2 Commands
```bash
# Start application with PM2
pm2 start /home/live_ecommerce/saffron_ecommerce/vms-ucbl/ecosystem.config.cjs

# Save PM2 configuration
pm2 save

# Configure PM2 to start on boot
sudo env PATH=$PATH:/usr/bin /usr/local/lib/node_modules/pm2/bin/pm2 startup systemd -u live_ecommerce --hp /home/live_ecommerce

# Verify status
pm2 status

# Output:
# ┌────┬────────────┬─────────────┬─────────┬─────────┬──────────┬────────┬──────┬───────────┬──────────┐
# │ id │ name       │ namespace   │ version │ mode    │ pid      │ uptime │ ↺    │ status    │ cpu      │ mem      │
# ├────┼────────────┼─────────────┼─────────┼─────────┼──────────┼────────┼──────┼───────────┼──────────┤
# │ 0  │ saffron    │ default     │ N/A     │ fork    │ 90040    │ 15m    │ 2    │ online    │ 0%       │ 63.0mb   │
# └────┴────────────┴─────────────┴─────────┴─────────┴──────────┴────────┴──────┴───────────┴──────────┘
```

---

### 5. Nginx Web Server Configuration

#### Install Nginx
```bash
sudo apt-get install -y nginx
```

#### Nginx Configuration (/etc/nginx/sites-available/saffron)
```nginx
# HTTP to HTTPS redirect
server {
    listen 80;
    server_name saffronsweets.com.bd www.saffronsweets.com.bd;
    return 301 https://$host$request_uri;
}

# HTTPS server
server {
    listen 443 ssl;
    server_name saffronsweets.com.bd www.saffronsweets.com.bd;

    # Let's Encrypt SSL Certificate
    ssl_certificate /etc/letsencrypt/live/saffronsweets.com.bd/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/saffronsweets.com.bd/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    client_max_body_size 100M;

    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_read_timeout 300;
    }
}
```

#### Enable Nginx Site
```bash
# Create symlink to enable site
sudo ln -sf /etc/nginx/sites-available/saffron /etc/nginx/sites-enabled/saffron

# Remove default site
sudo rm -f /etc/nginx/sites-enabled/default

# Test configuration
sudo nginx -t

# Reload Nginx
sudo systemctl reload nginx

# Enable Nginx on boot
sudo systemctl enable nginx
```

---

### 6. SSL Certificate (Let's Encrypt)

#### Install Certbot
```bash
sudo apt-get install -y certbot python3-certbot-nginx
```

#### Generate SSL Certificate
```bash
# Stop Nginx temporarily
sudo systemctl stop nginx

# Generate certificate (standalone mode)
sudo certbot certonly --standalone -d saffronsweets.com.bd -d www.saffronsweets.com.bd --non-interactive --agree-tos --email ashrafulunisoft@gmail.com

# Start Nginx
sudo systemctl start nginx

# Certificate Details:
# - Certificate Path: /etc/letsencrypt/live/saffronsweets.com.bd/fullchain.pem
# - Private Key Path: /etc/letsencrypt/live/saffronsweets.com.bd/privkey.pem
# - Expiry Date: 2026-07-05 (VALID: 89 days)
# - Auto-renewal: Enabled (systemd timer)
```

#### SSL Auto-Renewal
```bash
# Test renewal (dry run)
sudo certbot renew --dry-run

# Force renewal
sudo certbot renew --nginx

# List certificates
sudo certbot certificates
```

---

## 📋 Current Services Status

| Service | Status | Port | Access URL |
|---------|--------|------|------------|
| **Laravel App (PM2)** | ✅ Online | 8000 | Internal (127.0.0.1:8000) |
| **Nginx** | ✅ Active | 80, 443 | https://saffronsweets.com.bd |
| **MySQL** | ✅ Running | 3307 | Internal + phpMyAdmin |
| **Redis** | ✅ Running | 6380 | Internal |
| **phpMyAdmin** | ✅ Running | 8080 | http://182.160.114.66:8080 |

| **PM2 systemd** | ✅ Enabled | - | Auto-starts on boot |
| **Nginx systemd** | ✅ Enabled | - | Auto-starts on boot |
| **Certbot timer** | ✅ Enabled | - | Auto-renews SSL |

---

## 🌐 Public URLs

| URL | Description |
|-----|-------------|
| https://saffronsweets.com.bd | **Main website (HTTPS)** |
| http://saffronsweets.com.bd | Redirects to HTTPS |
| http://182.160.114.66 | Redirects to HTTPS |
| http://182.160.114.66:8080 | phpMyAdmin |

---

## 🔐 Credentials

| Service | Username | Password | Notes |
|---------|----------|----------|-------|
| MySQL Root | root | 786Shuvo | Full privileges |
| MySQL User | admin | 786Shuvo | Database: saffron_db |
| phpMyAdmin | Use MySQL credentials | - | Server: mysql, User: admin, Pass: 786Shuvo |
| Server sudo | live_ecommerce | @786Shuvooo | System sudo password |

---

## 🛠️ Useful Commands

### Application Management (PM2)
```bash
pm2 status              # Check application status
pm2 logs saffron       # View application logs (real-time)
pm2 logs saffron --lines 100  # View last 100 lines
pm2 restart saffron    # Restart application
pm2 stop saffron        # Stop application
pm2 start saffron       # Start application
pm2 save               # Save process list
pm2 resurrect           # Restore processes after reboot
```

### Web Server (Nginx)
```bash
sudo systemctl status nginx     # Check Nginx status
sudo systemctl start nginx      # Start Nginx
sudo systemctl stop nginx       # Stop Nginx
sudo systemctl restart nginx    # Restart Nginx
sudo systemctl reload nginx     # Reload config without downtime
sudo nginx -t                   # Test configuration syntax
sudo nginx -s reload            # Reload configuration
```
### Docker Services
```bash
cd /home/live_ecommerce/saffron_ecommerce/vms-ucbl

docker-compose ps              # Check container status
docker-compose logs            # View all logs
docker-compose logs mysql      # View MySQL logs
docker-compose restart         # Restart all containers
docker-compose restart mysql   # Restart MySQL container
docker-compose down            # Stop and remove containers
docker-compose up -d           # Start containers in background
```

### SSL Certificate Management
```bash
sudo certbot certificates           # List all certificates
sudo certbot renew --nginx         # Renew certificates
sudo certbot renew --dry-run       # Test renewal (dry run)
sudo certbot delete --cert-name saffronsweets.com.bd  # Delete certificate
```

### Laravel Application
```bash
cd /home/live_ecommerce/saffron_ecommerce/vms-ucbl

# Cache Management
php artisan cache:clear          # Clear application cache
php artisan config:clear         # Clear configuration cache
php artisan view:clear           # Clear compiled views
php artisan route:clear          # Clear route cache
php artisan optimize:clear       # Clear optimized classes

# Database
php artisan migrate              # Run migrations
php artisan migrate:fresh        # Fresh migration (WARNING: deletes all data)
php artisan db:seed              # Run seeders

php artisan storage:link         # Fix storage symlink

# Maintenance
php artisan down                 # Enable maintenance mode
php artisan up                   # Disable maintenance mode
```

### System & Monitoring
```bash
# Service status
sudo systemctl status nginx      # Nginx status
sudo systemctl status docker     # Docker status
pm2 status                       # PM2 status

# Logs
sudo tail -f /var/log/nginx/error.log      # Nginx error log
sudo tail -f /var/log/nginx/access.log     # Nginx access log
pm2 logs saffron                         # Application logs
docker-compose logs -f                  # Docker logs (follow mode)

# System resources
htop                             # System monitoring (if installed)
df -h                            # Disk usage
free -h                          # Memory usage
```

---

## 📁 Important File Paths

| Path | Description |
|------|-------------|
| `/home/live_ecommerce/saffron_ecommerce/vms-ucbl/` | Project root directory |
| `/home/live_ecommerce/saffron_ecommerce/vms-ucbl/.env` | Environment configuration |
| `/home/live_ecommerce/saffron_ecommerce/vms-ucbl/docker-compose.yml` | Docker services configuration |
| `/home/live_ecommerce/saffron_ecommerce/vms-ucbl/ecosystem.config.cjs` | PM2 configuration |
| `/home/live_ecommerce/saffron_ecommerce/vms-ucbl/public/storage` | Storage symlink (→ storage/app/public) |
| `/home/live_ecommerce/saffron_ecommerce/vms-ucbl/storage/app/public/products/` | Product images |
| `/etc/nginx/sites-available/saffron` | Nginx site configuration |
| `/etc/letsencrypt/live/saffronsweets.com.bd/` | SSL certificates |
| `/home/live_ecommerce/.pm2/` | PM2 configuration directory |

---

## ⚠️ Troubleshooting

### If website is not accessible:
```bash
# 1. Check if services are running
pm2 status
sudo systemctl status nginx
docker-compose ps

# 2. Check logs
pm2 logs saffron --lines 50
sudo tail -50 /var/log/nginx/error.log

# 3. Restart services
pm2 restart saffron
sudo systemctl restart nginx
```

### If SSL certificate error:
```bash
# Check certificate status
sudo certbot certificates

# Renew certificate
sudo certbot renew --nginx --force-renewal
```

### If database connection error:
```bash
# Check MySQL container
docker-compose ps mysql
docker-compose logs mysql

# Restart MySQL
docker-compose restart mysql

# Check credentials in .env match docker-compose.yml
```

### If storage/images not loading:
```bash
# Fix storage symlink
rm public/storage
php artisan storage:link

# Check permissions
chmod -R 775 storage/app/public
```

---

## 📝 Notes

1. **SSL Auto-Renewal**: Certbot is configured to automatically renew certificates twice daily. The certificate will renew automatically before expiration.

2. **PM2 Auto-Start**: PM2 starts automatically on server boot via `pm2-live_ecommerce` systemd service.
3. **Nginx Auto-Start**: Nginx is enabled to start on server boot.
4. **Storage Symlink**: Points to `/home/live_ecommerce/saffron_ecommerce/vms-ucbl/storage/app/public`
5. **IPv6 DNS**: AAAA record exists but Let's Encrypt validated via IPv4 successfully.

6. **Product Images**: Located in `storage/app/public/products/` directory.

---

## ⚠️ Future Tasks / Recommendations

- [ ] Set up automated database backups
- [ ] Configure production error monitoring (e.g., Sentry)
- [ ] Set up log rotation for Laravel logs
- [ ] Configure queue workers for background jobs
- [ ] Review and optimize product images (compression)
- [ ] Set up CDN for static assets
- [ ] Configure email queue for transactional emails
- [ ] Implement Redis session locking for multi-server setup

- [ ] Monitor SSL certificate expiration (89 days)

- [ ] Set up UFW firewall rules (if not already configured)

- [ ] Consider upgrading to PHP-FPM socket for better performance

---

*Document Created: April 6, 2026*  
*Last Updated: April 6, 2026*
