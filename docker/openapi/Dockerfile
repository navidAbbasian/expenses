FROM swaggerapi/swagger-ui

RUN apk update \
    && apk add openssl
RUN sh -c 'echo -n "nextpay:$(openssl passwd -apr1 1234)" >> /etc/nginx/.htpasswd'
COPY ./docker/openapi/fpm-template.conf /etc/nginx/templates/default.conf.template

EXPOSE 8080
