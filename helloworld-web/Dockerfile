FROM andreyst/debootstrap-wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get install -y \
    php5=5.4.4-14+deb7u14 \
    php5-cli=5.4.4-14+deb7u14 \
    php5-common=5.4.4-14+deb7u14 \
    php5-curl=5.4.4-14+deb7u14 \
    php5-dev=5.4.4-14+deb7u14 \
    php5-fpm=5.4.4-14+deb7u14 \
    php5-gd=5.4.4-14+deb7u14 \
    php5-imagick=3.1.0~rc1-1+b2 \
    php5-memcache=3.0.6-6 \
    php5-mysql=5.4.4-14+deb7u14
ADD helloworld /var/www/helloworld

##################################################
 NEXT STEPS:
 - add php-fpm config to run helloworld pool
 - test that it servers correctly
##################################################