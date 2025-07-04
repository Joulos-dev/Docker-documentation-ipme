FROM php:8.3.4-fpm

# Install needed packages
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions zip sockets pdo_mysql intl gd && \
    rm -f /usr/local/bin/install-php-extensions

# Set PHP limits
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory_limit.ini
RUN echo "post_max_size=64M" > /usr/local/etc/php/conf.d/post_max_size.ini
RUN echo "upload_max_filesize=64M" > /usr/local/etc/php/conf.d/upload_max_filesize.ini

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Create dev user with UID/GID 1000
RUN addgroup --gid 1000 devgroup && \
    adduser --disabled-password --gecos "" --uid 1000 --gid 1000 devuser && \
    mkdir -p /var/www && \
    chown -R devuser:devgroup /var/www

# Switch to devuser
USER devuser
WORKDIR /var/www

CMD ["php-fpm"]
