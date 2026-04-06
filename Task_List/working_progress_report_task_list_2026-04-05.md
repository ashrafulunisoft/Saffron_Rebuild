# Server Setup Task List - Saffron Dairy and Sweets
**Date:** 2026-04-05
**Server:** Saffron-Sweets-Bakery
**IP:** 182.160.114.66
**User:** live_ecommerce

---

## Server Connection Command
```bash
ssh Saffron-Sweets-Bakery
# or
ssh live_ecommerce@182.160.114.66
```

---

## 1. Initial Setup - System updates, timezone, hostname

**Why:** A fresh server needs updates for security patches and proper time configuration for logs and scheduled tasks.

**Commands:**
```bash
# Connect to server
ssh Saffron-Sweets-Bakery

# Update package lists and upgrade all packages
sudo apt update && sudo apt upgrade -y

# Set hostname (identifies server in terminal)
sudo hostnamectl set-hostname saffron-server

# Set timezone to Bangladesh (important for cron jobs and logs)
sudo timedatectl set-timezone Asia/Dhaka

# Create swap file (helps when RAM is low - 2GB swap for 2GB RAM server)
sudo fallocate -l 2G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
```

**Checklist:**
- [ ] Connect to server via SSH
- [ ] Update system packages
- [ ] Set server hostname
- [ ] Configure timezone to Asia/Dhaka
- [ ] Create swap file (2GB recommended)

---

## 2. Security Configuration - UFW firewall, SSH hardening, Fail2Ban

**Why:** Protect your server from unauthorized access and brute-force attacks.

### UFW Firewall
```bash
# Install UFW (usually pre-installed)
sudo apt install ufw -y

# Allow SSH first (IMPORTANT: do this before enabling!)
sudo ufw allow 22/tcp
# Or if you change SSH port later: sudo ufw allow 2222/tcp

# Allow web traffic
sudo ufw allow 80/tcp    # HTTP
sudo ufw allow 443/tcp   # HTTPS

# Enable firewall
sudo ufw enable

# Check status
sudo ufw status verbose
```

### SSH Hardening
```bash
# Edit SSH config
sudo nano /etc/ssh/sshd_config

# Recommended changes:
# Port 22                    # Change to custom port (e.g., 2222)
# PermitRootLogin no         # Disable root login
# PasswordAuthentication no  # Force key-based auth (after setting up keys)
# PubkeyAuthentication yes

# Restart SSH service
sudo systemctl restart sshd
```

### Fail2Ban (blocks repeated failed login attempts)
```bash
# Install Fail2Ban
sudo apt install fail2ban -y

# Create local config
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local
sudo nano /etc/fail2ban/jail.local

# Basic settings in jail.local:
# [DEFAULT]
# bantime = 1h
# findtime = 10m
# maxretry = 5

# Enable and start
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

**Checklist:**
- [ ] Configure UFW firewall (allow 22, 80, 443)
- [ ] Enable UFW
- [ ] Disable root SSH login
- [ ] Setup SSH key authentication
- [ ] Install and configure Fail2Ban

---

## 3. Install Docker & Docker Compose

**Why:** Docker allows you to run applications in containers (isolated environments), making deployment consistent and easy.

```bash
# Install dependencies
sudo apt install -y apt-transport-https ca-certificates curl software-properties-common gnupg lsb-release

# Add Docker's official GPG key
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Add Docker repository
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Install Docker
sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Add your user to docker group (so you don't need sudo)
sudo usermod -aG docker live_ecommerce

# Start and enable Docker
sudo systemctl start docker
sudo systemctl enable docker

# Verify installation
docker --version
docker compose version
```

**After adding user to docker group, logout and login again for changes to take effect.**

**Checklist:**
- [ ] Install Docker dependencies
- [ ] Add Docker GPG key and repository
- [ ] Install Docker Engine
- [ ] Install Docker Compose plugin
- [ ] Add user to docker group
- [ ] Enable Docker to start on boot
- [ ] Verify Docker and Docker Compose installation

---

## 4. Database Setup - MySQL/PostgreSQL

**Why:** Your Laravel application needs a database to store data.

### Option A: Docker MySQL Container (Recommended)
```bash
# Create a docker-compose.yml file
mkdir -p ~/saffron && cd ~/saffron

cat > docker-compose.yml << 'EOF'
services:
  db:
    image: mysql:8.0
    container_name: saffron_db
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: your_strong_root_password
      MYSQL_DATABASE: saffron_db
      MYSQL_USER: saffron_user
      MYSQL_PASSWORD: your_strong_password
    volumes:
      - db_data:/var/lib/mysql
    ports:
      - "3306:3306"

volumes:
  db_data:
EOF

# Start the database
docker compose up -d
```

### Option B: Native MySQL Installation
```bash
# Install MySQL
sudo apt install mysql-server -y

# Secure installation
sudo mysql_secure_installation

# Create database and user
sudo mysql
```
```sql
CREATE DATABASE saffron_db;
CREATE USER 'saffron_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON saffron_db.* TO 'saffron_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

**Checklist:**
- [ ] Setup MySQL (Docker or native)
- [ ] Configure database credentials
- [ ] Create application database (saffron_db)
- [ ] Create database user with appropriate privileges
- [ ] Test database connection
- [ ] Configure database backup strategy

---

## 5. Web Server & SSL - Nginx and Let's Encrypt

**Why:** Nginx serves your website and acts as a reverse proxy. SSL provides HTTPS encryption.

### Install Nginx
```bash
sudo apt install nginx -y
sudo systemctl enable nginx
sudo systemctl start nginx
```

### Install PHP-FPM (for Laravel)
```bash
# Add PHP repository
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Install PHP 8.2 and extensions
sudo apt install -y php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath php8.2-intl php8.2-redis

# Start PHP-FPM
sudo systemctl start php8.2-fpm
sudo systemctl enable php8.2-fpm
```

### Nginx Configuration for Laravel
```bash
sudo nano /etc/nginx/sites-available/saffron
```
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/saffron/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```
```bash
# Enable the site
sudo ln -s /etc/nginx/sites-available/saffron /etc/nginx/sites-enabled/

# Remove default site
sudo rm /etc/nginx/sites-enabled/default

# Test configuration
sudo nginx -t

# Reload Nginx
sudo systemctl reload nginx
```

### Install SSL with Certbot
```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Get SSL certificate (run after domain propagates)
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

**Checklist:**
- [ ] Install Nginx
- [ ] Install PHP-FPM and extensions
- [ ] Configure Nginx virtual host for Laravel
- [ ] Enable the site
- [ ] Install Certbot
- [ ] Setup SSL certificate (after domain propagation)

---

## 6. Domain Propagation - DNS Monitoring

**Why:** Your domain needs to point to your server's IP before SSL and website access works.

### DNS Configuration (at your domain registrar)
```
Type: A      Name: @        Value: 182.160.114.66
Type: A      Name: www      Value: 182.160.114.66
Type: CNAME  Name: www      Value: yourdomain.com (alternative)
```

### Check Propagation from Local Machine
```bash
# Using dig
dig yourdomain.com

# Using nslookup
nslookup yourdomain.com

# Get only IP
dig +short yourdomain.com
```

### Online DNS Propagation Checkers
- https://dnschecker.org
- https://whatsmydns.net
- https://propagation.io

### Continuous Check Script (run locally)
```bash
#!/bin/bash
while true; do
  echo "Checking at $(date):"
  dig +short yourdomain.com
  echo "---"
  sleep 300  # Check every 5 minutes
done
```

**Checklist:**
- [ ] Configure DNS A record to point to 182.160.114.66
- [ ] Configure www subdomain
- [ ] Check domain propagation status
- [ ] Verify domain resolves to correct IP
- [ ] Test domain accessibility with curl

---

## 7. Project Deployment - Upload and configure Saffron Dairy and Sweets

**Why:** Deploy your Laravel application to the server.

### Upload Project Files
```bash
# From your local machine - using rsync (recommended)
rsync -avz --progress /path/to/saffron-project/ Saffron-Sweets-Bakery:/var/www/saffron/

# Or using scp
scp -r /path/to/saffron-project/ Saffron-Sweets-Bakery:/var/www/saffron/
```

### Setup on Server
```bash
# Create directory
sudo mkdir -p /var/www/saffron
sudo chown -R live_ecommerce:www-data /var/www/saffron

# Set permissions
cd /var/www/saffron
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

### Configure Environment
```bash
# Copy and configure .env
cp .env.example .env
nano .env
```

### Key .env Settings
```env
APP_NAME="Saffron Dairy and Sweets"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1  # or db container name
DB_PORT=3306
DB_DATABASE=saffron_db
DB_USERNAME=saffron_user
DB_PASSWORD=your_strong_password
```

### Final Setup Commands
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Link storage
php artisan storage:link

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Checklist:**
- [ ] Upload project files to server
- [ ] Setup project directory structure
- [ ] Configure file permissions
- [ ] Configure environment variables (.env file)
- [ ] Install composer dependencies
- [ ] Run database migrations
- [ ] Setup storage link
- [ ] Optimize for production

---

## 8. Additional Tools - Git, Composer, Node.js, Redis, Supervisor

**Why:** Essential tools for Laravel application management.

### Git
```bash
sudo apt install git -y
git config --global user.name "Your Name"
git config --global user.email "your@email.com"
```

### Composer
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Verify
composer --version
```

### Node.js & NPM (for frontend assets)
```bash
# Install Node.js 20.x
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Verify
node -v
npm -v
```

### Redis (for caching and queues)
```bash
sudo apt install redis-server -y
sudo systemctl enable redis-server
sudo systemctl start redis-server

# Verify
redis-cli ping  # Should return PONG
```

### Supervisor (keeps queue workers running)
```bash
sudo apt install supervisor -y

# Create config for Laravel queues
sudo nano /etc/supervisor/conf.d/saffron-worker.conf
```
```ini
[program:saffron-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/saffron/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/saffron/storage/logs/worker.log
stopwaitsecs=3600
```
```bash
# Apply supervisor config
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all

# Check status
sudo supervisorctl status
```

**Checklist:**
- [ ] Install Git
- [ ] Install Composer
- [ ] Install Node.js & NPM
- [ ] Install Redis
- [ ] Install and configure Supervisor

---

## 9. Monitoring & Maintenance - Backups, cron jobs

**Why:** Ensure data safety and automate scheduled tasks.

### Database Backup Script
```bash
# Create backup directory
mkdir -p ~/backups

# Create backup script
nano ~/backups/backup.sh
```
```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/home/live_ecommerce/backups"
DB_NAME="saffron_db"
DB_USER="saffron_user"
DB_PASS="your_password"

# Create backup
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_$DATE.sql

# Compress
gzip $BACKUP_DIR/db_$DATE.sql

# Delete backups older than 7 days
find $BACKUP_DIR -name "*.gz" -mtime +7 -delete

echo "Backup completed: db_$DATE.sql.gz"
```
```bash
chmod +x ~/backups/backup.sh
```

### Setup Cron Jobs
```bash
crontab -e
```
```cron
# Laravel scheduler (run every minute)
* * * * * cd /var/www/saffron && php artisan schedule:run >> /dev/null 2>&1

# Daily backup at 2 AM
0 2 * * * /home/live_ecommerce/backups/backup.sh >> /home/live_ecommerce/backups/backup.log 2>&1
```

### Log Rotation
```bash
sudo nano /etc/logrotate.d/saffron
```
```
/var/www/saffron/storage/logs/*.log {
    daily
    rotate 14
    compress
    missingok
    notifempty
    create 0644 www-data www-data
}
```

**Checklist:**
- [ ] Create backup script
- [ ] Setup automated backups
- [ ] Configure Laravel scheduler cron
- [ ] Setup log rotation

---

## 10. Final Verification - Testing everything works

**Why:** Confirm all services are running correctly.

### Check All Services
```bash
# Check Docker
docker ps

# Check Nginx
sudo systemctl status nginx

# Check PHP-FPM
sudo systemctl status php8.2-fpm

# Check MySQL
sudo systemctl status mysql
# Or for Docker: docker ps | grep mysql

# Check Redis
redis-cli ping  # Should return PONG

# Check Supervisor
sudo supervisorctl status
```

### Test Website
```bash
# Test from server (HTTP)
curl -I http://localhost

# Test from server (HTTPS - after SSL setup)
curl -I https://localhost

# Test domain
curl -I https://yourdomain.com
```

### Test Database Connection
```bash
# For native MySQL
mysql -u saffron_user -p -e "SELECT 1"

# For Docker MySQL
docker exec -it saffron_db mysql -u saffron_user -p -e "SELECT 1"
```

### Check Logs for Errors
```bash
# Nginx error log
sudo tail -f /var/log/nginx/error.log

# Nginx access log
sudo tail -f /var/log/nginx/access.log

# Laravel log
tail -f /var/www/saffron/storage/logs/laravel.log

# PHP-FPM log
sudo tail -f /var/log/php8.2-fpm/error.log
```

### Quick Health Check Script
```bash
#!/bin/bash
echo "=== Service Status Check ==="
echo "Nginx: $(systemctl is-active nginx)"
echo "PHP-FPM: $(systemctl is-active php8.2-fpm)"
echo "MySQL: $(systemctl is-active mysql)"
echo "Redis: $(redis-cli ping)"
echo "Supervisor: $(sudo supervisorctl status)"
echo "=== Disk Usage ==="
df -h /
echo "=== Memory Usage ==="
free -h
```

**Checklist:**
- [ ] Test website accessibility (HTTP)
- [ ] Verify SSL certificate is valid (HTTPS)
- [ ] Check all services are running
- [ ] Test database connectivity
- [ ] Check logs for errors
- [ ] Verify queue workers are running
- [ ] Test email functionality (if applicable)
- [ ] Test file uploads

---

## Notes
- Domain propagation may take 24-48 hours - continue checking periodically
- Keep SSH connection alive during long operations
- Document all passwords and credentials securely
- Take server snapshots before major changes
- Remember to update APP_URL in .env after domain is configured

---

## Important Files Locations
| File | Path |
|------|------|
| Nginx config | `/etc/nginx/sites-available/saffron` |
| PHP-FPM config | `/etc/php/8.2/fpm/pool.d/www.conf` |
| Laravel .env | `/var/www/saffron/.env` |
| Laravel logs | `/var/www/saffron/storage/logs/laravel.log` |
| Supervisor config | `/etc/supervisor/conf.d/saffron-worker.conf` |
| Backups | `/home/live_ecommerce/backups/` |

---

*Created: 2026-04-05*
*Server: Saffron-Sweets-Bakery (182.160.114.66)*
