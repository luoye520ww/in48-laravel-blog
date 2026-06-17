FROM nginx:1.27-alpine

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY public /var/www/html/in48-laravel-blog/public
