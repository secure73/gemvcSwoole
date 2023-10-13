FROM openswoole/swoole:4.12.1-php8.2
RUN  apt update
RUN  apt upgrade -y
RUN  composer self-update
RUN  mv html app
COPY composer.json .
RUN  composer install
COPY . .
CMD [ "php","server.php" ]