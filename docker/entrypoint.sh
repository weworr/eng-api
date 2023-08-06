#! /bin/bash

composer install
chmod -R 777 *

apache2-foreground
