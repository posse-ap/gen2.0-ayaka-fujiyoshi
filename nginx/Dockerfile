FROM nginx:latest

ADD ./conf/default.conf /etc/nginx/conf.d/default.conf
ADD ./webapp /usr/share/nginx/html

RUN echo "start nginx"