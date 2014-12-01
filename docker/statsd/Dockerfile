FROM andreyst/debian-base
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

RUN echo 'Acquire::http::Proxy { deb.nodesource.com DIRECT; };' >> /etc/apt/apt.conf.d/99proxy

RUN echo 'deb https://deb.nodesource.com/node wheezy main' > /etc/apt/sources.list.d/nodesource.list
RUN echo 'deb-src https://deb.nodesource.com/node wheezy main' >> /etc/apt/sources.list.d/nodesource.list

RUN groupadd -r statsd \
    && useradd -r -g statsd statsd

COPY conf/nodesource_signing.key /tmp/nodesource_signing.key
RUN apt-key add /tmp/nodesource_signing.key && rm /tmp/nodesource_signing.key

RUN apt-get update && apt-get install -y \
       nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY pkg/statsd /opt/statsd/
COPY conf/config.js /opt/statsd/

RUN mkdir -p /var/log/statsd \
    && chown statsd:statsd /var/log/statsd

VOLUME ["/var/log"]

EXPOSE 8125

COPY docker-entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

WORKDIR /opt/statsd

CMD [ "node", "stats.js", "config.js", "| tee -a /var/log/statsd/statsd.log" ]
