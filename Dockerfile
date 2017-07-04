FROM ubuntu:latest

RUN apt-get update
RUN apt-get -y install apache2

RUN apt-get -y install libapache2-mod-php7.0 php7.0 php7.0-cli php-xdebug php7.0-mbstring sqlite3 php7.0-mysql \
    php-imagick php-memcached php-pear curl imagemagick php7.0-dev php7.0-phpdbg php7.0-gd \
    npm nodejs php7.0-json php7.0-curl php7.0-sqlite3 php7.0-intl apache2 wget libsasl2-dev libssl-dev \
    libsslcommon2-dev libcurl4-openssl-dev openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev \
  && a2enmod headers \
  && a2enmod rewrite \
  && curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer.phar \
  && alias composer='/usr/local/bin/composer.phar'

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
RUN ln -sf /dev/stdout /var/log/apache2/access.log && \
    ln -sf /dev/stderr /var/log/apache2/error.log
RUN mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR $APACHE_LOG_DIR

COPY . /var/www/html
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT [ "/usr/sbin/apache2" ]

RUN npm install
#RUN composer install

CMD ["-D", "FOREGROUND"]