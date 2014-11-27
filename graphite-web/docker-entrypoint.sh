#!/bin/bash
set -e

chown graphite-web:graphite-web /data/graphite-web
mkdir -p /var/log/graphite-web
chown graphite-web:graphite-web /var/log/graphite-web

echo "Running gosu..."
exec gosu graphite-web "$@"
