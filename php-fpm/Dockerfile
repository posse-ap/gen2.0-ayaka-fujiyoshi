FROM php:8.0-fpm-alpine

# install configure file      
  #PHP の設定ファイルである php.ini を作成
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
  #PDOのMySQL用ドライバをPHP-FPMサーバにインストール
    docker-php-ext-install pdo_mysql

# settings
  #追加で設定するための PHP 設定ファイルを設置
COPY php.ini /usr/local/etc/php/conf.d/php.ini
