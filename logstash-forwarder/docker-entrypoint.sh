#!/bin/bash
set -e

# if [ "$1" = "logstash-forwarder" ]; then

  # NOT NEEDED WHILE KEY/CRT ARE PREGENERATED AND PUT THERE BY DOCKER
  # LOGSTASH_FORWARDER_KEY="/etc/pki/tls/private/logstash-forwarder.key"
  # LOGSTASH_FORWARDER_CERT="/etc/pki/tls/certs/logstash-forwarder.crt"
  # if [ ! -f "LOGSTASH_FORWARDER_KEY" ] || [ ! -f "LOGSTASH_FORWARDER_CERT" ]; then
  #   mkdir -p "/etc/pki/tls/private"
  #   mkdir -p "/etc/pki/tls/certs/"
  #   openssl req -x509 -batch -nodes -newkey rsa:2048 -keyout "${LOGSTASH_FORWARDER_KEY}" -out "${LOGSTASH_FORWARDER_CERT}" -days 365
  # fi

# fi

sed -i "s~#LOGSTASH_ADDRESS#~${LOGSTASH_PORT_57840_TCP_ADDR}:${LOGSTASH_PORT_57840_TCP_PORT}~" /etc/logstash-forwarder.conf

exec gosu root "$@"
