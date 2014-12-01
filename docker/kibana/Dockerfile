FROM andreyst/debian-openjdk-7
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN groupadd -r kibana && useradd -r -g kibana kibana

COPY pkg/kibana-4.0.0-BETA2 /usr/share/kibana-4.0.0-BETA2

VOLUME ["/var/log"]

COPY conf/kibana.yml /usr/share/kibana-4.0.0-BETA2/config/

EXPOSE 5601

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/usr/share/kibana-4.0.0-BETA2/bin/kibana"]
