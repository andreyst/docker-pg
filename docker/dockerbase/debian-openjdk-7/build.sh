#!/bin/bash

cd $(dirname $0)
docker build -t andreyst/debian-openjdk-7 .
