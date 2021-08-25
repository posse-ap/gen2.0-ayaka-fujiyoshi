FROM ubuntu:16.04


RUN apt-get update
RUN apt-get install -y vim curl tmux
RUN locale-gen ja_JP.UTF-8
ENV LANG ja_JP.UTF-8
ENV TZ Asia/Tokyo
WORKDIR /linux-study