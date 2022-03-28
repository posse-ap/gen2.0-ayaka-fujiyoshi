<?php
$DATABASE_NAME = "webapp";
$CHARACTER_CODE = "charset=utf8mb4";
define('HOSTNAME', 'db');
define('DATABASE_NAME', 'webapp');
$PDO_DSN = "mysql:host=mysql;dbname=" . $DATABASE_NAME . ";" . $CHARACTER_CODE . ";";
         // ↑DB_HOSTはserviceの名前, 今回はdocker-compose.ymlでmysqlと命名している
         // 連結演算子「.」で文字列と変数を結合
$DB_USERNAME = "mysql";
$DB_PASSWORD = "password";  
$OPTIONS = array(
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);