#!/bin/bash

echo "================================================"
echo "Saffron PHP Configuration Setup"
echo "================================================"
echo ""
echo "This script will configure PHP for proper file upload handling"
echo ""

# Check if running as root
if [ "$EUID" -ne 0 ]; then
    echo "Please run this script with sudo:"
echo "  sudo bash setup-php.sh"
    echo ""
    exit 1
fi

PHP_INI="/etc/php/8.4/cli/php.ini"
BACKUP_INI="/etc/php/8.4/cli/php.ini.backup.$(date +%Y%m%d_%H%M%S)"

# Backup original php.ini
echo "📦 Backing up original php.ini to: $BACKUP_INI"
cp "$PHP_INI" "$BACKUP_INI"

# Update upload limits
echo "⚙️  Updating PHP configuration..."

sed -i 's/^upload_max_filesize = .*/upload_max_filesize = 10M/' "$PHP_INI"
sed -i 's/^post_max_size = .*/post_max_size = 20M/' "$PHP_INI"
sed -i 's/^memory_limit = .*/memory_limit = 256M/' "$PHP_INI"
sed -i 's/^max_execution_time = .*/max_execution_time = 300/' "$PHP_INI"
sed -i 's/^max_input_time = .*/max_input_time = 300/' "$PHP_INI"

echo ""
echo "✅ Configuration updated successfully!"
echo ""
echo "Current PHP Settings:"
php -i | grep -E "upload_max_filesize|post_max_size|memory_limit"
echo ""
echo "Please restart your PHP server:"
echo "  1. Stop current server (Ctrl+C)"
echo "  2. Run: php artisan serve"
echo ""
