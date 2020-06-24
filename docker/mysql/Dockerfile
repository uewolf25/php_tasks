FROM mysql:5.7

ENV MYSQL_ROOT_PASSWORD hogehoge
ENV MYSQL_ROOT_HOST 172.28.0.1

ENV MYSQL_DATABASE task
ENV MYSQL_USER tasker
ENV MYSQL_PASSWORD task

COPY init.d/* /docker-entrypoint-initdb.d/

EXPOSE 3306

CMD ["--sql-mode=NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION", \
 "--skip-character-set-client-handshake", \
 "--default-time-zone=+00:00"]

