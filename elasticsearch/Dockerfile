FROM andreyst/debootstrap-wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'Acquire::http { Proxy "http://192.168.59.103:3142"; };' >> /etc/apt/apt.conf.d/01proxy && \
    echo "deb http://packages.elasticsearch.org/elasticsearch/1.4/debian stable main" > /etc/apt/sources.list.d/elasticsearch.list

ADD elasticsearch_signing.key /tmp/elasticsearch_signing.key

# grab gosu for easy step-down from root
RUN gpg --keyserver pgp.mit.edu --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4
RUN apt-key add /tmp/elasticsearch_signing.key
RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/* \
    && curl -o /usr/local/bin/gosu -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture)" \
    && curl -o /usr/local/bin/gosu.asc -SL "https://github.com/tianon/gosu/releases/download/1.2/gosu-$(dpkg --print-architecture).asc" \
    && gpg --verify /usr/local/bin/gosu.asc \
    && rm /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && apt-get purge -y --auto-remove curl

RUN apt-get update && apt-get install -y \
    elasticsearch \
    openjdk-7-jdk

VOLUME ["/data"]
VOLUME ["/var/log"]

ADD elasticsearch.yml /etc/elasticsearch/

RUN sed -i "s~start-stop-daemon --start -b~start-stop-daemon --start~" /etc/init.d/elasticsearch && \
    sed -i "s~DAEMON_OPTS=\"-d~DAEMON_OPTS=\"~" /etc/init.d/elasticsearch

EXPOSE 9200
EXPOSE 9300

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/etc/init.d/elasticsearch", "start"]
