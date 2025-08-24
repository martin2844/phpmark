#!/bin/sh

# PHPMark Framework - Development Entrypoint

echo "🚀 Starting PHPMark Framework in development mode..."

# Set proper permissions on mounted volumes
chown -R webuser:webuser /var/www
chmod -R 755 /var/www

echo "📁 Permissions set for development"

# Start PHP-FPM in background
echo "🐘 Starting PHP-FPM..."
php-fpm &

# Start nginx in foreground
echo "🌐 Starting nginx..."
nginx -g "daemon off;"