FROM andreyst/wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'Acquire::http { Proxy "http://192.168.59.103:3142"; };' >> /etc/apt/apt.conf.d/01proxy

RUN apt-get update && apt-get install -y \
       nano \
       curl \
       apt-transport-https \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY pkg/gosu /usr/local/bin/
