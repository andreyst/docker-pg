FROM andreyst/debian-php5-fpm

COPY . /var/www/helloworld/

RUN rm /var/www/helloworld/Dockerfile && \
    mkdir -p /var/storage/helloworld/cache && \
    mkdir -p /var/storage/helloworld/meta && \
    mkdir -p /var/storage/helloworld/sessions && \
    mkdir -p /var/storage/helloworld/views && \
    chown www-data -R /var/storage/helloworld && \
    chmod 775 -R /var/storage/helloworld

COPY conf/helloworld.conf /etc/php5/fpm/pool.d/

WORKDIR /var/www/helloworld

COPY ./docker-entrypoint.sh /
ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["php5-fpm"]
