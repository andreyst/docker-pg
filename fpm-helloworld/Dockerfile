FROM andreyst/debootstrap-wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive
ENV HOME /root

RUN echo 'Acquire::http { Proxy "http://192.168.59.103:3142"; };' >> /etc/apt/apt.conf.d/01proxy

# grab gosu for easy step-down from root
RUN gpg --keyserver pgp.mit.edu --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4
RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/* \
    && curl -o /usr/local/bin/gosu -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture)" \
    && curl -o /usr/local/bin/gosu.asc -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture).asc" \
    && gpg --verify /usr/local/bin/gosu.asc \
    && rm /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && apt-get purge -y --auto-remove curl

RUN apt-get update && apt-get install -y \
    php5=5.4.4-14+deb7u14 \
    php5-cli=5.4.4-14+deb7u14 \
    php5-common=5.4.4-14+deb7u14 \
    php5-curl=5.4.4-14+deb7u14 \
    php5-dev=5.4.4-14+deb7u14 \
    php5-fpm=5.4.4-14+deb7u14 \
    php5-gd=5.4.4-14+deb7u14 \
    php5-mcrypt=5.4.4-14+deb7u14 \
    php5-imagick=3.1.0~rc1-1+b2 \
    php5-memcache=3.0.6-6 \
    php5-mysql=5.4.4-14+deb7u14

ADD php-fpm/helloworld.conf /etc/php5/fpm/pool.d/helloworld.conf
ADD php-fpm/php-fpm.conf /etc/php5/fpm/php-fpm.conf

VOLUME ["/var/log"]

ADD helloworld /var/www/helloworld

RUN mkdir /opt/composer

WORKDIR /opt/composer

RUN php -r "readfile('https://getcomposer.org/installer');" | php && \
    ln -s /opt/composer/composer.phar /usr/local/bin/composer

#RUN sed -e 's/;daemonize = yes/daemonize = no/' -i /etc/php5/fpm/php-fpm.conf && \
RUN \
    #
    # Clean up
    #
    rm /etc/php5/fpm/pool.d/www.conf && \
    #
    # Laravel
    #
    mkdir -p /var/storage/helloworld/cache && \
    mkdir -p /var/storage/helloworld/meta && \
    mkdir -p /var/storage/helloworld/sessions && \
    mkdir -p /var/storage/helloworld/views && \
    chown www-data -R /var/storage/helloworld && \
    chmod 775 -R /var/storage/helloworld

EXPOSE 9000

WORKDIR /var/www/helloworld

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["php5-fpm"]

