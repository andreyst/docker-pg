#!/bin/bash
set -e

if [ -z "$HELLOWORLD_PORT" ]; then
  echo "Cannot find HELLOWORLD_PORT env, check if this container is running"
  exit 1
fi

if [ -z "$GRAPHITEWEB_PORT" ]; then
  echo "Cannot find GRAPHITEWEB_PORT env, check if this container is running"
  exit 1
fi

sed -i "s~\#HELLOWORLD_ADDRESS\#~${HELLOWORLD_PORT_9000_TCP_ADDR}:${HELLOWORLD_PORT_9000_TCP_PORT}~" /etc/nginx/sites-available/helloworld.conf

sed -i "s~\#GRAPHITEWEB_ADDRESS\#~${GRAPHITEWEB_PORT_3031_TCP_ADDR}:${GRAPHITEWEB_PORT_3031_TCP_PORT}~" /etc/nginx/sites-available/graphite-web.conf

mkdir -p /var/log/nginx
chown nginx -R /var/log/nginx

/etc/init.d/nginx configtest

exec gosu root "$@"
