#!/bin/bash
set -e

chown graphite-carbon:graphite-carbon /data/graphite-carbon
mkdir -p /var/log/graphite-carbon
chown graphite-carbon:graphite-carbon /var/log/graphite-carbon

echo "Running gosu..."
exec gosu graphite-carbon "$@"
