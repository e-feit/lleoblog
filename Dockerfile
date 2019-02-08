FROM php:7.3-apache

COPY . /var/www/html/

RUN	apt-get update && \
	apt-get install -y libpng-dev && \
	apt-get install -y curl && \
	sleep 3 && \
	docker-php-ext-install -j4 mysqli gd mbstring json pdo pdo_mysql session && \
	mv /var/www/html/config.php.tmpl /var/www/html/config.php && \
	sed -i 's/\$msq_host = "localhost"/\$msq_host = "lleoblog-mysql"/g' /var/www/html/config.php && \
	chmod 777 -R /var/www/html/ && \
	a2enmod rewrite

EXPOSE 80
