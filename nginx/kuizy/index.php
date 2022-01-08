<?php

// require('../kuizy/index-PDO.php');

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

//大問テーブルの選択
  //  $id = 1; とここで指定することもできるが汎用性がない
 $id = filter_input(INPUT_GET, 'id');
 $stmt = $db->prepare("SELECT name FROM big_questions WHERE id= ? "); // SELECT文を変数に格納
 $stmt->bindValue(1,$id);  //第一引数のパラメータID,SQL内の「?」の位置を指定
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

//設問テーブルのデータ取得
//  $big_question_id = filter_input(INPUT_GET, 'id');
//  $big_question_id = 1;
 $images_sql = 'SELECT id, big_question_id, image FROM questions  WHERE big_question_id= ? '; //こっちのwhereの後のはページに何を載せるのかをこのテーブルの中で何を基準にするかを指定？？
 $images_stmt = $db->prepare($images_sql);
 $images_stmt->bindValue(1, $id); //ここでURLのidごとにページ表示切り替えできてる
 $images_stmt->execute();
 $images_result = $images_stmt->fetchAll();
 echo "</br>" . "</br>" .  $images_result[0];
 echo "</br>" . "</br>" .  $images_result[1];
 echo "</br>" . "</br>" .  $images_result[2];
 echo "</br>" . "</br>" .  $images_result['image'];
 echo "</br>" . "</br>" ;
 echo "</br>" . "</br>" .  print_r($images_result);

 
//選択肢テーブルのデータ取得
//  $question_id = filter_input(INPUT_GET, 'id');
 $choices_sql = 'SELECT id, question_id, name, valid FROM choices';
 $choices_stmt = $db->query($choices_sql);
//  $choices_stmt->bindValue(1,$id);
//  $choices_stmt->execute();
//  $questions_choices = $choices_stmt->fetch();


//間違えてqueryで書いて一応表示はできることは確認できた
//  設問テーブルのデータ取得
//   $images_sql = 'SELECT id, big_question_id, image FROM questions';
//   $images_stmt = $db->query( $images_sql);
//  選択肢テーブルのデータ取得
//   $choices_sql = 'SELECT id, question_id, name, valid FROM choices';
//   $choices_stmt = $db->query($choices_sql);
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







   <!-- 試しに -->
      <table>
        <tr>
          <th>ID</th> 
          <th><br></th>
          <th>ユーザー名</th>
        </tr>
        <?php foreach ($images_result as $row_images) {?>
        <tr>
          <td><?php echo $row_images['id']; ?></td>
          <td><?php echo $row_images['big_question_id']; ?></td>
          <td><?php echo $row_images['image']; ?></td>
        </tr>
        <?php } ?>
        <th><br></th>
        <?php foreach ($choices_stmt as $row_choices) {?>
        <tr>
          <td><?php echo $row_choices['id']; ?></td>
          <td><?php echo $row_choices['question_id']; ?></td>
          <td><?php echo $row_choices['name']; ?></td>
          <td><?php echo $row_choices['valid']; ?></td>
        </tr>
        <?php } ?>
      </table>
	</div>

   <!-- <div class='mainWrapper'>  
      queryで書いちゃった時の↓、広島のにも高輪とか表示されちゃう
      一問目だけはいい感じに表示されるけど他ダメ、
      設問と画像はセットで表示されていい感じだけど選択肢が違うテーブルからひっぱってくるから何か上手いこといかない
      <?php $x = 1; ?>
      <?php $limit = 2; ?>

      <?php $y = 1; ?>
      <?php $limitY = 3; ?>

      <?php foreach ($images_stmt as $row_images) {?>
         <?php if ($x > $limit){?>
            <?php break;?>
         <?php } else {?>
             -- 設問番号↓ --
                   <h3><?php echo $row_images['id']; ?>.この地名はなんて読む？</h3>
             -- 写真↓ --
                   <img src= 'img/<?php echo $row_images['image']; ?>'  alt='問題${i+1}の写真' width=auto>
             -- 選択肢↓ --
                   <?php foreach ($choices_stmt as $row_choices) {?>
                        <?php if ($y > $limitY){?>
                           <?php break;?>
                        <?php } else {?>
                         <ul>
                            <li class='buttonOfOptionNumber' id = 'answerChoice_${i}_0' ><?php echo $row_choices['name']; ?></li>
                         </ul>
                         <?php $y++; ?>
                      <?php } ?>
                     
                   <?php } ?>
         <?php } ?>
         <?php $x++; ?>
      <?php } ?> -->


  
</body>
</html>