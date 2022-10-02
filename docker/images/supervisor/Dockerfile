FROM ubuntu:20.04

RUN apt-get update && apt-get install supervisor -y

RUN apt install lsb-release ca-certificates apt-transport-https software-properties-common -y
RUN add-apt-repository ppa:ondrej/php

RUN apt install php8.1 -y
RUN apt install php8.1-pgsql -y \
    php8.1-gd \
    php8.1-fpm \
#    php8.1-cli \
    php8.1-common \
    php8.1-imap \
    php8.1-redis \
    php8.1-snmp \
    php8.1-xml \
    php8.1-zip \
    php8.1-mbstring

#RUN systemctl status php8.0-fpm start

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY worker.conf /etc/supervisor/conf.d/worker.conf

EXPOSE 8008

CMD ["/usr/bin/supervisord"]