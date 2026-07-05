#!/usr/bin/env bash
# Start nginx as the public web server on port 5000. nginx serves static
# assets directly and reverse-proxies dynamic requests to the PHP backend on
# 127.0.0.1:8080. Running nginx in front of PHP's built-in server is required
# because the built-in server does not support HTTP keep-alive and drops
# concurrent connections behind the Replit proxy (ERR_CONNECTION_CLOSED).
set -e

cd /home/runner/workspace

mkdir -p .nginx/tmp/client_body .nginx/tmp/proxy .nginx/tmp/fastcgi \
         .nginx/tmp/uwsgi .nginx/tmp/scgi

# Validate config, then run in the foreground (daemon off; in nginx.conf).
nginx -p /home/runner/workspace -c scripts/nginx.conf -t
exec nginx -p /home/runner/workspace -c scripts/nginx.conf
