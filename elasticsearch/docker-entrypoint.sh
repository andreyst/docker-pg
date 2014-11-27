#!/bin/bash
set -e

dirs=( \
  /data/data \
  /data/log \
  /data/plugins \
  /data/work \
)

for dir in "${dirs[@]}"; do
  if [ ! -d "$dir" ]; then
    mkdir "$dir"
  fi
done

chown -R elasticsearch /data

exec gosu root "$@"
