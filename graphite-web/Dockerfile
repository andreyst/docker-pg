FROM andreyst/debootstrap-wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'Acquire::http { Proxy "http://192.168.59.103:3142"; };' >> /etc/apt/apt.conf.d/01proxy

RUN groupadd -r graphite-web && useradd -r -g graphite-web graphite-web

# grab gosu for easy step-down from root
RUN gpg --keyserver pgp.mit.edu --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4
RUN apt-get update && apt-get install -y curl openssl && rm -rf /var/lib/apt/lists/* \
    && curl -o /usr/local/bin/gosu -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture)" \
    && curl -o /usr/local/bin/gosu.asc -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture).asc" \
    && gpg --verify /usr/local/bin/gosu.asc \
    && rm /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && apt-get purge -y --auto-remove curl

 RUN apt-get update && apt-get install -y \
    python=2.7.3-4+deb7u1

ADD graphite-web-0.9.10.tar.gz /usr/src/

RUN cd /usr/src/graphite-web-0.9.10/ && python setup.py install

ADD local_settings.py /opt/graphite/webapp/graphite

RUN cd /opt/graphite/webapp/graphite python manage.py syncdb

VOLUME ["/var/log"]
VOLUME ["/data/graphite-web"]

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

WORKDIR /opt/graphite/bin

# --debug to foreground it
CMD ["./carbon-cache.py", "--debug", "start"]
