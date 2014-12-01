#!/bin/bash

cd $(dirname $0)
cat wheezy.tar | docker import - andreyst/wheezy
