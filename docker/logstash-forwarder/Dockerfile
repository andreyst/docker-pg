FROM andreyst/debian-openjdk-7
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
     openssl \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

COPY pkg/logstash-forwarder /usr/local/bin/

VOLUME ["/var/log"]
VOLUME ["/data/logstash-forwarder"]

COPY conf/logstash-forwarder.conf /etc/
COPY conf/logstash-forwarder.key /etc/pki/tls/private/logstash-forwarder.key
COPY conf/logstash-forwarder.crt /etc/pki/tls/certs/logstash-forwarder.crt

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

WORKDIR /data/logstash-forwarder

CMD ["logstash-forwarder", "-config", "/etc/logstash-forwarder.conf", "-verbose", "-debug=true"]
