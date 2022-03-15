<?php
try {
  $db = new PDO($PDO_DSN, $DB_USERNAME, $DB_PASSWORD, $OPTIONS);  // PDOインスタンスを生成
  echo 'DB接続成功';
} catch (PDOException $e) {         //エラー情報が入ったオブジェクトを e で受け取り, getMessage() というメソッドで表示
  echo $e->getMessage() . PHP_EOL;
  echo 'DB接続失敗';
  exit;
}
