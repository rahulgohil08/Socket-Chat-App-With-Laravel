web: vendor/bin/heroku-php-nginx -C nginx_app.conf /public
worker: php artisan queue:restart && php artisan queue:work database --tries=3
web: node --optimize_for_size --max_old_space_size=460 --gc_interval=100 server.js
