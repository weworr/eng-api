#! /bin/sh

composer install
chmod -R 777 var vendor

# shellcheck disable=SC2093
exec /usr/bin/supervisord -c /etc/supervisor/supervisor.conf
exec "$@"
