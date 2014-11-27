FROM andreyst/debootstrap-wheezy
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>
ENV DEBIAN_FRONTEND noninteractive

VOLUME ["/var/cache/apt-cacher-ng"]

RUN apt-get update && apt-get install -y \
    apt-cacher-ng=0.7.11-2

EXPOSE 3142

CMD chmod 777 /var/cache/apt-cacher-ng && /etc/init.d/apt-cacher-ng start && tail -f /var/log/apt-cacher-ng/*
