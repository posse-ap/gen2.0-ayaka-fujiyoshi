
<?php
$DATABASE_NAME = "quiz";
$CHARACTER_CODE = "charset=utf8mb4";
$PDO_DSN = "mysql:host=mysql;dbname=" . $DATABASE_NAME . ";" . $CHARACTER_CODE . ";";
         // ↑DB_HOSTはserviceの名前, 今回はdocker-compose.ymlでmysqlと命名している
         // 連結演算子「.」で文字列と変数を結合
$DB_USERNAME = "mysql";
$DB_PASSWORD = "password";  
$OPTIONS = array(
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

try{
 // PDOインスタンスを生成
 $db = new PDO($PDO_DSN,$DB_USERNAME,$DB_PASSWORD,$OPTIONS);

 // SELECT文を変数に格納
//  $sql_1 = "SELECT * FROM big_questions WHERE id = 1 ";

//  $id = $_GET["name"];
//  $id = 1;
 $id = filter_input(INPUT_GET, 'id');
 $stmt = $db->prepare("SELECT name FROM big_questions WHERE id= ? ");
 $stmt->bindValue(1,$id);
 $stmt->execute();
 $name = $stmt->fetch();
//  echo "<a href='./index.php'>$name[0]</a>";
 echo "<a href='./index.html'>$name[0]</a>";
 
 echo 'DB接続成功';
 } catch(PDOException $e){
 //エラーの情報が入ったオブジェクトを e で受け取ることができる
    //e には getMessage() というメソッドが定義されている
    //getMessage() を呼び出したあとに、分かりやすく改行も付
 echo $e->getMessage() . PHP_EOL;
 echo 'DB接続失敗';
 exit;
      // -> could not find driver DB接続失敗 -> Dockerfileに追加
}
