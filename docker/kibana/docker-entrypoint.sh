#!/bin/bash
set -e

echo "Running gosu..."
exec gosu kibana "$@"
