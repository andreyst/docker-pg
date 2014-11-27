#!/bin/bash
set -e

if [ -z "$FPMHELLOWORLD_PORT" ]; then
  echo "Cannot find FPMHELLOWORLD_PORT env, check if this container is running"
  exit 1
fi

FPMHELLOWORLD_PORT=$(echo ${FPMHELLOWORLD_PORT} | sed -e "s~tcp://~~g")
sed -i "s~\#FPMHELLOWORLD_PORT\#~${FPMHELLOWORLD_PORT}~" /etc/nginx/sites-available/helloworld.conf

chown nginx -R /var/log/nginx

/etc/init.d/nginx configtest

exec gosu root "$@"
