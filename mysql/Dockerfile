FROM mysql:latest

ADD ./my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf

CMD ["mysqld", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci", "--default-time-zone = 'Asia/Tokyo'"]
CMD ["mysql", "--default-character-set=utf8"]
CMD ["client", "--default-character-set=utf8"]
