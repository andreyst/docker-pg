#!/bin/bash

cd $(dirname $0)
docker build -t andreyst/debian-python-2.7 .
