FROM andreyst/debian-python-2.7
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN groupadd -r graphite-carbon \
    && useradd -r -g graphite-carbon graphite-carbon \
    && groupadd -r graphite \
    && usermod -G graphite graphite-carbon

RUN apt-get update && apt-get install -y \
       build-essential \
       python-dev \
       python-pip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN pip install Twisted==13.1.0 whisper==0.9.10 carbon==0.9.10 graphite-web==0.9.10

COPY conf/carbon.conf /opt/graphite/conf/
COPY conf/storage-schemas.conf /opt/graphite/conf/

VOLUME ["/var/log"]
VOLUME ["/data/graphite-carbon"]

EXPOSE 2003
EXPOSE 2004

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

WORKDIR /opt/graphite/bin

# --debug to foreground it
CMD ["./carbon-cache.py", "--debug", "start"]
