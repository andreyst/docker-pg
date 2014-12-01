FROM andreyst/debian-base
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN echo "deb http://repo.percona.com/apt wheezy main" > /etc/apt/sources.list.d/percona.list && \
    echo "deb-src http://repo.percona.com/apt wheezy main" >> /etc/apt/sources.list.d/percona.list

COPY conf/percona_signing.key /tmp/percona_signing.key

RUN apt-key add /tmp/percona_signing.key && rm /tmp/percona_signing.key

RUN apt-get update && apt-get install -y \
       percona-server-server-5.6 \
       percona-server-client-5.6 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

VOLUME /data/mysql
VOLUME ["/var/log"]

COPY conf/my.cnf /etc/mysql/my.cnf

EXPOSE 3306

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

WORKDIR /usr/local/mysql

CMD ["mysqld", "--datadir=/data/mysql", "--user=mysql"]