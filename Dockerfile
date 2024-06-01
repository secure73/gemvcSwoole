FROM openswoole/swoole:latest
RUN apt update
RUN apt upgrade -y
RUN composer self-update
RUN composer create-project gemvc/installer .
RUN mv html app
CMD [ "php","server.php" ]