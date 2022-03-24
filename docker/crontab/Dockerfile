FROM php:8.0-cli-alpine3.13

WORKDIR /app

#RUN docker-php-ext-install pdo pdo_mysql

#COPY crontab.sh /etc/crontabs/root

COPY crontab.sh /
RUN chmod +x /crontab.sh
ENTRYPOINT ["/crontab.sh"]
