#!/bin/bash
set -e

sed -i "s~#ELASTICSEARCH_SERVER_HOST#~${ELASTICSEARCH_PORT_9200_TCP_ADDR}~" /etc/logstash.conf
sed -i "s~#ELASTICSEARCH_SERVER_PORT#~${ELASTICSEARCH_PORT_9200_TCP_PORT}~" /etc/logstash.conf

mkdir -p /var/log/logstash
chown -R logstash:logstash /var/log/logstash

echo "Running gosu..."
exec gosu logstash "$@"
