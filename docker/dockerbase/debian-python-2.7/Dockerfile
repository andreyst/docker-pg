FROM andreyst/debian-base

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
       python=2.7.3-4+deb7u1 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
