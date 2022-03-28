<?php
$DATABASE_NAME = "webapp";
$CHARACTER_CODE = "charset=utf8mb4";
$PDO_DSN = "mysql:host=mysql;dbname=" . $DATABASE_NAME . ";" . $CHARACTER_CODE . ";";
         // ↑DB_HOSTはserviceの名前, 今回はdocker-compose.ymlでmysqlと命名している
         // 連結演算子「.」で文字列と変数を結合
$DB_USERNAME = "mysql";
$DB_PASSWORD = "password";  
$OPTIONS = array(
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

define('DATABASE_NAME','webapp');
define('CHARACTER_CODE','charset=utf8mb4');
define('DSN','mysql:host=localhost;dbname=dbname;charset=utf8');
define('DB_USER','user');
define('DB_PASSWORD','pass');
error_reporting(E_ALL & ~E_NOTICE);