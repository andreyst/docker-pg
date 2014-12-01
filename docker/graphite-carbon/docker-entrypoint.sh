#!/bin/bash
set -e

chown -R graphite-carbon:graphite /data/graphite-carbon
find /data/graphite-carbon -type d -exec chmod 755 {} +
find /data/graphite-carbon -type f -exec chmod 644 {} +
mkdir -p /var/log/graphite-carbon
chown graphite-carbon:graphite-carbon /var/log/graphite-carbon

rm -f /data/graphite-carbon/carbon-cache-a.pid

echo "Running gosu..."
exec gosu graphite-carbon "$@"
