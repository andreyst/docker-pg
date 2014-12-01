FROM andreyst/debian-python-2.7
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN groupadd -r graphite-carbon \
    && useradd -r -g graphite-carbon graphite-carbon \
    && groupadd -r graphite-web \
    && useradd -r -g graphite-web graphite-web \
    && groupadd -r graphite \
    && usermod -G graphite graphite-carbon \
    && usermod -G graphite graphite-web

RUN apt-get update && apt-get install -y \
       python-django \
       python-cairo \
       python-django-tagging \
       python-memcache \
       python-pysqlite2 \
       build-essential \
       python-dev \
       python-pip \
       uwsgi-plugin-python \
       uwsgi \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN pip install Twisted==13.1.0 whisper==0.9.10 carbon==0.9.10 graphite-web==0.9.10

COPY conf/local_settings.py /opt/graphite/webapp/graphite/

COPY conf/uwsgi /etc/default/
COPY conf/default.ini /etc/uwsgi/
COPY conf/apps-available/graphite.ini /etc/uwsgi/apps-available/
COPY conf/wsgi.py /opt/graphite/conf/
RUN ln -s /etc/uwsgi/apps-available/graphite.ini /etc/uwsgi/apps-enabled/

RUN mkdir /run/uwsgi /run/uwsgi/app \
    && chown -R graphite-web:graphite-web /run/uwsgi

VOLUME ["/var/log"]
VOLUME ["/data/graphite-web"]
VOLUME ["/data/graphite-carbon"]

EXPOSE 3031

COPY ./docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/usr/bin/uwsgi", "--ini", "/etc/uwsgi/default.ini"]
