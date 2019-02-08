FROM php:7.3-apache

COPY . /var/www/html/

RUN	apt-get update && \
	apt-get install -y libpng-dev && \
	apt-get install -y curl && \
	apt-get install -y libjpeg62-turbo-dev && \
	sleep 3 && \
	docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ && \
	docker-php-ext-install -j4 mysqli gd mbstring json pdo pdo_mysql session && \
	docker-php-ext-enable gd && \
	mv /var/www/html/config.php.tmpl /var/www/html/config.php && \
	sed -i 's/\$msq_host = "localhost"/\$msq_host = "lleoblog-mysql"/g' /var/www/html/config.php && \
	chmod 777 -R /var/www/html/ && \
	a2enmod rewrite

RUN pecl install xdebug-2.7.0beta1
RUN docker-php-ext-enable xdebug
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini

EXPOSE 80
