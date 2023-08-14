FROM openswoole/swoole:4.12.1-php8.2
RUN apt update
RUN apt upgrade -y
RUN composer self-update
RUN composer require gemvc/library