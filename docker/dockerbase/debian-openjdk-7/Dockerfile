FROM andreyst/debian-base
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
       openjdk-7-jdk \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
