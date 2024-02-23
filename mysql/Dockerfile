FROM mysql:8.1

COPY ./mysql/schema.sql /docker-entrypoint-initdb.d/

EXPOSE 3306

VOLUME [ "/var/lib/mysql" ]

# FROM mysql:latest

# ENV MYSQL_ROOT_PASSWORD=root 

# COPY ./schema.sql /docker-entrypoint-initdb.d/
