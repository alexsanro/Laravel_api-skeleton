FROM ubuntu:18.04
RUN apt-get update -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y tzdata && \
    apt-get install -y php7.2 php7.2-xml php7.2-mysql php-mbstring zip curl 
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
EXPOSE 8000
WORKDIR /app
