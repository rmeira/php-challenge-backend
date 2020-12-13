#!/bin/sh

# FIRST DEFINE WWW FOLDER
cd /var/www

su - www-data -s /bin/bash -c 'php artisan clear-compiled'
su - www-data -s /bin/bash -c 'php artisan optimize'
su - www-data -s /bin/bash -c 'php artisan passport:keys --force'
su - www-data -s /bin/bash -c 'php artisan migrate --force'
su - www-data -s /bin/bash -c 'php artisan permission:cache-reset'

exec supervisord  -c /etc/supervisord.conf
