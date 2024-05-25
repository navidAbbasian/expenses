FROM nginx:latest

ENV NGINX_ROOT /build

RUN sh -c 'echo -n "nextpay:$(openssl passwd -apr1 1234)" >> /etc/nginx/.htpasswd'
RUN apt-get -y update && apt-get -y install php
RUN curl -O https://doctum.long-term.support/releases/latest/doctum.phar && chmod +x doctum.phar

RUN rm -f /etc/nginx/conf.d/default.conf
RUN rm -f /etc/nginx/nginx.conf

COPY ./docker/phpdoc/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/phpdoc/fpm-template.conf /etc/nginx/fpm.tmpl
COPY ./docker/phpdoc/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY ./docker/phpdoc/config.php /config.php

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
