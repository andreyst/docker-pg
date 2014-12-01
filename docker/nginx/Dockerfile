FROM andreyst/debian-base
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo "deb http://nginx.org/packages/debian/ wheezy nginx" > /etc/apt/sources.list.d/nginx.list && \
    echo "deb-src http://nginx.org/packages/debian/ wheezy nginx" >> /etc/apt/sources.list.d/nginx.list

COPY conf/nginx_signing.key /tmp/nginx_signing.key
RUN apt-key add /tmp/nginx_signing.key && rm /tmp/nginx_signing.key

RUN apt-get update && apt-get install -y \
       nginx=1.6.2-1~wheezy \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

VOLUME ["/var/log"]

COPY conf/nginx.conf /etc/nginx/
COPY conf/conf.d/* /etc/nginx/conf.d/
COPY conf/sites-available/* /etc/nginx/sites-available/

RUN \
    #
    # Clean up
    #
    rm /etc/nginx/conf.d/example_ssl.conf && \
    rm /etc/nginx/conf.d/default.conf && \
    #
    # Nginx
    #
    touch /var/log/nginx/nginx.log && \
    chown nginx:nginx /var/log/nginx/nginx.log && \
    mkdir /etc/nginx/sites-enabled/ && \
    ln -s /etc/nginx/sites-available/* /etc/nginx/sites-enabled/

EXPOSE 80

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["nginx"]
