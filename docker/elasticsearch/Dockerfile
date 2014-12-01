FROM andreyst/debian-openjdk-7
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

RUN echo "deb http://packages.elasticsearch.org/elasticsearch/1.4/debian stable main" > /etc/apt/sources.list.d/elasticsearch.list

COPY conf/elasticsearch_signing.key /tmp/elasticsearch_signing.key
RUN apt-key add /tmp/elasticsearch_signing.key && rm /tmp/elasticsearch_signing.key

RUN apt-get update && apt-get install -y \
       elasticsearch \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

VOLUME ["/data"]
VOLUME ["/var/log"]

COPY conf/elasticsearch.yml /etc/elasticsearch/

RUN sed -i "s~start-stop-daemon --start -b~start-stop-daemon --start~" /etc/init.d/elasticsearch && \
    sed -i "s~DAEMON_OPTS=\"-d~DAEMON_OPTS=\"~" /etc/init.d/elasticsearch

EXPOSE 9200
EXPOSE 9300

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/etc/init.d/elasticsearch", "start"]
