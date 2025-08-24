FROM php:8.3-fpm-alpine

LABEL maintainer="PHPMark Framework"
LABEL description="Simple SSR Blog Framework - Production"

# Install nginx
RUN apk add --no-cache nginx

# Create web user with proper permissions
RUN adduser -D -s /bin/sh webuser && \
    addgroup webuser www-data

# PHP optimizations for production
RUN docker-php-ext-install opcache && \
    echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=64" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Copy source code first
COPY . /var/www/

# Copy configs
COPY docker/nginx.prod.conf /etc/nginx/nginx.conf
COPY docker/php-fpm.prod.conf /usr/local/etc/php-fpm.d/www.conf

# Create required directories and set permissions
RUN mkdir -p /tmp/nginx /run/nginx /var/log/nginx /var/lib/nginx /var/www && \
    chmod -R 755 /var/www && \
    chown -R webuser:webuser /var/www /var/log/nginx /var/lib/nginx /tmp/nginx /run/nginx

EXPOSE 8080

# Start both PHP-FPM and nginx
CMD php-fpm & nginx -g "daemon off;"