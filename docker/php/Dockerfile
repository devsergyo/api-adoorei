FROM php:8.3-fpm

WORKDIR /var/www

RUN rm -rf /var/www/html

# Add Ondrej's repo source and signing key along with dependencies
RUN apt update && apt upgrade && apt install -y \
    lsb-release \
    ca-certificates \
    curl \
    apt-transport-https \
    wget && \
    curl -sSLo /tmp/debsuryorg-archive-keyring.deb https://packages.sury.org/debsuryorg-archive-keyring.deb && \
    dpkg -i /tmp/debsuryorg-archive-keyring.deb && \
    sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' && \
    apt update && apt upgrade && apt install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    nano \
    unzip \
    git \
    libzip-dev \
    bzip2 \
    libbz2-dev sqlite3 libsqlite3-dev libssl-dev libcurl4-openssl-dev libreadline-dev libtidy-dev libxslt-dev \
    apt-utils \
    libonig-dev \
    libicu-dev
#memcached pdo_mysql pdo_pgsql pgsql xdebug
RUN docker-php-ext-install zip pdo_mysql mbstring exif intl bz2 bcmath
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

RUN mkdir -p /usr/src/php/ext/redis; \
	curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; \
	docker-php-ext-install redis;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 laravel
RUN useradd -u 1000 -ms /bin/bash -g laravel user

COPY --chown=user:laravel . /var/www

USER user

EXPOSE 9000

CMD ["php-fpm"]