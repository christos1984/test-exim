FROM php:7.2.6-apache

RUN apt-get clean && apt-get update && apt-get -y upgrade && apt-get install -y exim4 git zip ssl-cert && \
    rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /var/www/data/
RUN chmod -R 777 /var/www/data/
#COPY /docker/php/sd.conf /etc/apache2/sites-available/
RUN a2enmod rewrite


COPY ./.docker/php/php.ini /usr/local/etc/php
COPY ./.docker/php/composer.sh /var/www/data

COPY /.docker/php/sd.conf /etc/apache2/sites-available/

WORKDIR /etc/apache2/sites-available
RUN a2ensite sd
WORKDIR /var/www/html/

RUN echo 'sendmail_path = "/usr/sbin/exim4 -bs"' >> /usr/local/etc/php/conf.d/mail.ini && \
    echo 'SMTP = localhost' >> /usr/local/etc/php/conf.d/mail.ini && \
    echo 'smtp_port = 25' >> /usr/local/etc/php/conf.d/mail.ini

COPY ./.docker/php/exim4.conf /etc/exim4/exim4.conf
RUN chmod 644 /etc/exim4/exim4.conf

