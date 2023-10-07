#! /bin/sh

composer install
chmod -R 777 *

exec "$@"
