#!/bin/bash

if [ "x$1" == "--import-base" ]; then
  wheezy/build.sh
fi

debian-base/build.sh
for dir in $(ls -1 | grep -v "^wheezy$" | grep -v "^debian-base$"); do
  bash $dir/build.sh
done

