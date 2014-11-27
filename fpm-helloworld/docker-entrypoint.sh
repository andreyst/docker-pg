#!/bin/bash
set -e

for env_var in $(env | grep "^DB\|REDIS" | cut -d'=' -f1); do
  echo "env[$env_var] = \$$env_var" >> /etc/php5/fpm/pool.d/*
done

if [ ! -d "/var/log/helloworld" ]; then
  mkdir /var/log/helloworld
fi
chown www-data -R /var/log/helloworld

exec gosu root "$@"
