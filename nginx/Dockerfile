FROM andreyst/debootstrap-wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'Acquire::http { Proxy "http://192.168.59.103:3142"; };' >> /etc/apt/apt.conf.d/01proxy && \
    echo "deb http://nginx.org/packages/debian/ wheezy nginx" > /etc/apt/sources.list.d/nginx.list && \
    echo "deb-src http://nginx.org/packages/debian/ wheezy nginx" >> /etc/apt/sources.list.d/nginx.list

ADD nginx/nginx_signing.key /tmp/nginx_signing.key

# grab gosu for easy step-down from root
RUN gpg --keyserver pgp.mit.edu --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4
RUN apt-key add /tmp/nginx_signing.key
RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/* \
    && curl -o /usr/local/bin/gosu -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture)" \
    && curl -o /usr/local/bin/gosu.asc -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture).asc" \
    && gpg --verify /usr/local/bin/gosu.asc \
    && rm /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && apt-get purge -y --auto-remove curl

RUN apt-get update && apt-get install -y \
    nginx=1.6.2-1~wheezy

VOLUME ["/var/log"]

ADD nginx/nginx.conf /etc/nginx/
ADD nginx/conf.d/* /etc/nginx/conf.d/
ADD nginx/sites-available/* /etc/nginx/sites-available/

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
