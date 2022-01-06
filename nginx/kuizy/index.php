
<?php

require('../kuizy/index-PDO.php');

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
//  // PDOインスタンスを生成
//  $db = new PDO($PDO_DSN,$DB_USERNAME,$DB_PASSWORD,$OPTIONS);

 // SELECT文を変数に格納
//  $sql_1 = "SELECT * FROM big_questions WHERE id = 1 ";

//  $id = $_GET["name"];
//  $id = 1;
 $id = filter_input(INPUT_GET, 'id');
 $stmt = $db->prepare("SELECT name FROM big_questions WHERE id= ? ");
 $stmt->bindValue(1,$id);
 $stmt->execute();
 $id_name = $stmt->fetch();
 echo "<a href='./index.html'>$id_name[0]</a>";
 
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

// $id_from_get = filter_input(INPUT_GET, 'id');
// $id = filter_input(INPUT_GET, 'id');
 
// $optionGroups = 
?>

<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Kuizy</title>
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    <link rel='stylesheet' href='kuizy.css'>
</head>
<body>

<!-- <h2 class='title'><?php $name[0]; ?></h2>  -->
<h2 class='title'><?= htmlspecialchars($id_name[0], ENT_QUOTES, 'UTF-8'); ?></h2> 
<!-- <h2 class='title'>aaaaa</h2>  -->


   <div class='mainWrapper'>
   <!-- 設問番号↓ -->
	   <h3>${i+1}.この地名はなんて読む？</h3>
   <!-- 写真↓ -->
         <img src= "${questionPhotos[i]}"  alt='問題${i+1}の写真' width=auto>
   <!-- 選択肢↓ -->
      <ul>
         <li class='buttonOfOptionNumber' id = 'answerChoice_${i}_0' >${optionGroups[i][0]}</li>
         <li class='buttonOfOptionNumber' id = 'answerChoice_${i}_1' >${optionGroups[i][1]}</li>
         <li class='buttonOfOptionNumber' id = 'answerChoice_${i}_2' >${optionGroups[i][2]}</li>
      </ul>
	</div>


  
</body>
</html>