#!/usr/bin/env bash

## Fix Cron issues
# Place the environment variables in a script for CRON jobs to be able to access them.
declare -p | grep -Ev 'BASHOPTS|BASH_VERSINFO|EUID|PPID|SHELLOPTS|UID' > /container.env

php /app/doctrine migrations:migrate --no-interaction

/usr/sbin/crond -l 8
/usr/bin/supervisord -c /etc/supervisord.conf
