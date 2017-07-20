#IMAGE
FROM ubuntu:latest
RUN apt-get update

RUN apt-get -y install php7.0 php7.0-cli curl php7.0-mysql \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer.phar \
    && alias composer='/usr/local/bin/composer.phar'


#COPY PROJECT
ADD .. /var/www/html

#ENTRY
WORKDIR /var/www/html
EXPOSE 80

#MYSQL
RUN echo "mysql-server-5.5 mysql-server/root_password password password" | debconf-set-selections
RUN echo "mysql-server-5.5 mysql-server/root_password_again password password" | debconf-set-selections
RUN apt-get -y install mysql-server

#NPM AND COMPOSER
RUN /usr/local/bin/composer.phar install

#DATABASE
RUN service mysql start \
    && mysql -u root -ppassword -e "CREATE DATABASE IF NOT EXISTS cocoturbo;" \
    && php artisan migrate \
    && php artisan db:seed

ENTRYPOINT service mysql start