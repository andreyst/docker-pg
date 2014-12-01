#!/bin/bash
set -e

if [ -z "$GRAPHITECARBON_PORT" ]; then
  echo "Cannot find GRAPHITECARBON_PORT env, check if this container is running"
  exit 1
fi

sed -i "s~\#GRAPHITE_HOST\#~${GRAPHITECARBON_PORT_2003_TCP_ADDR}~" /opt/statsd/config.js
sed -i "s~\#GRAPHITE_PORT\#~${GRAPHITECARBON_PORT_2003_TCP_PORT}~" /opt/statsd/config.js

exec gosu statsd "$@"
