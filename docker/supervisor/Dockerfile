FROM php:8.0-cli-alpine3.13

LABEL author="cy322666"

ENV APP_ROOT=/home/app QUEUE_DRIVER=database NUM_PROCS=4 OPTIONS=

ADD supervisord.conf /etc/

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    && apk update && apk add --no-cache supervisor

CMD ["supervisord", "-c", "/etc/supervisord.conf"]