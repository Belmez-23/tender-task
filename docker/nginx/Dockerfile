FROM nginx:1.17.8

RUN apt-get update --fix-missing && \
    apt-get install -y \
    nano vim

ADD default.conf /etc/nginx/conf.d/default.conf

WORKDIR /symfony