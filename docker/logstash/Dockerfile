FROM andreyst/debian-openjdk-7
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN groupadd -r logstash && useradd -r -g logstash logstash

COPY pkg/logstash-1.4.2.tar.gz /usr/share/

VOLUME ["/var/log"]

EXPOSE 57840

COPY conf/logstash.conf /etc/
COPY conf/logstash-forwarder.key /etc/pki/tls/private/
COPY conf/logstash-forwarder.crt /etc/pki/tls/certs/

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/usr/share/logstash-1.4.2/bin/logstash", "-f", "/etc/logstash.conf", "-l", "/var/log/logstash/logstash.log", "--verbose"]
