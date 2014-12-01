#!/bin/bash
set -e

mkdir -p /data/graphite-web/storage/
touch /data/graphite-web/storage/index

python /opt/graphite/webapp/graphite/manage.py syncdb --noinput

chown -R graphite-web:graphite /data/graphite-web
find /data/graphite-web -type d -exec chmod 755 {} +
find /data/graphite-web -type f -exec chmod 644 {} +

mkdir -p /var/log/graphite-web
chown graphite-web:graphite-web /var/log/graphite-web

echo "Running gosu..."
exec gosu root "$@"
