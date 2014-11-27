FROM andreyst/debootstrap-wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'Acquire::http { Proxy "http://192.168.59.103:3142"; };' >> /etc/apt/apt.conf.d/01proxy

RUN groupadd -r logstash && useradd -r -g logstash logstash

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
    openjdk-7-jdk

ADD logstash-1.4.2.tar.gz /usr/share/

VOLUME ["/var/log"]

EXPOSE 57840

ADD logstash.conf /etc/
ADD logstash-forwarder.key /etc/pki/tls/private/
ADD logstash-forwarder.crt /etc/pki/tls/certs/

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/usr/share/logstash-1.4.2/bin/logstash", "-f", "/etc/logstash.conf", "-l", "/var/log/logstash/logstash.log", "--verbose"]
