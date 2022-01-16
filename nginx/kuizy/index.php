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
 
 //大問・設問テーブルの結合、選択
  $id = filter_input(INPUT_GET, 'id');
  $sql = 'SELECT
          big_questions.id AS big_quiz_id,
          big_questions.name AS big_quiz_name,
          questions.id AS image_id,
          questions.image AS image_name
          FROM big_questions
          INNER JOIN questions
          ON  big_questions.id = questions.big_question_id
          WHERE big_questions.id= ? ';
  $stmt = $db->prepare($sql); // SELECT文を変数に格納
  $stmt->bindValue(1,$id);  //第一引数のパラメータID,SQL内の「?」の位置を指定
  $stmt->execute();
  $results = array();
  
//   $id_name = $stmt->fetch();
  
//   echo "<a href='./index.html'>$value['big_quiz_name']</a>";
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

 while($row = $stmt->fetch()) {
   $results[]=array(
      'big_quiz_id' =>$row['big_quiz_id'],
      'big_quiz_name' =>$row['big_quiz_name'],
      'image_id' =>$row['image_id'],
      'image_name' =>$row['image_name'],
   );
 }
 echo "</br>" . "</br>" .  var_dump($results);
// echo "</br>" . "</br>" .$results[0][0];

 //設問・選択テーブルの結合、選択
 $inner_sql = "SELECT
               questions.id AS image_id,
               questions.image AS image_name,
               choices.name AS choice_name,
               choices.valid AS choice_valid
               FROM questions
               INNER JOIN choices
               ON  questions.id = choices.question_id
               WHERE questions.big_question_id= ? ";
  $inner_stmt = $db->prepare($inner_sql); // SELECT文を変数に格納
  $inner_stmt->bindValue(1,$id);  //第一引数のパラメータID,SQL内の「?」の位置を指定
  $inner_stmt->execute();
  $inner_results = array();
  while($inner_row = $inner_stmt->fetch()) {
     $inner_results[]=array(
        'image_id' =>$inner_row['image_id'],
        'image_name' =>$inner_row['image_name'],
        'choice_name' =>$inner_row['choice_name'],
        'choice_valid' =>$inner_row['choice_valid']
     );
  }

 


// try{
//   // PDOインスタンスを生成
//  $db = new PDO($PDO_DSN,$DB_USERNAME,$DB_PASSWORD,$OPTIONS);
// 
//大問テーブルの選択
//   //  $id = 1; とここで指定することもできるが汎用性がない
//  $id = filter_input(INPUT_GET, 'id');
//  $stmt = $db->prepare("SELECT name FROM big_questions WHERE id= ? "); // SELECT文を変数に格納
//  $stmt->bindValue(1,$id);  //第一引数のパラメータID,SQL内の「?」の位置を指定
//  $stmt->execute();
//  $id_name = $stmt->fetch();

//  echo "<a href='./index.html'>$id_name[0]</a>";
 
//  echo 'DB接続成功';
//  } catch(PDOException $e){
//    //エラーの情報が入ったオブジェクトを e で受け取ることができる
//      //e には getMessage() というメソッドが定義されている
//      //getMessage() を呼び出したあとに、分かりやすく改行も付
//  echo $e->getMessage() . PHP_EOL;
//  echo 'DB接続失敗';
//  exit;
//    // -> could not find driver DB接続失敗 -> Dockerfileに追加
// }

//設問テーブルのデータ取得
//  $big_question_id = filter_input(INPUT_GET, 'id');
//  $images_sql = 'SELECT id, big_question_id, image FROM questions  WHERE big_question_id= ? '; //big_question_id= 1 or 2 で取得するデータかわる
//  $images_stmt = $db->prepare($images_sql);
//  $images_stmt->bindValue(1, $id); //ここでURLのidごとにページ表示切り替えできてる
//  $images_stmt->execute();
//  $images_result = $images_stmt->fetchAll();
//  echo "</br>" . "</br>" .  $images_result[0];
//  echo "</br>" . "</br>" .  $images_result[1];
//  echo "</br>" . "</br>" .  $images_result[2];
//  echo "</br>" . "</br>" .  $images_result['image'];
//  echo "</br>" . "</br>" ;
//  echo "</br>" . "</br>" .  print_r($images_result);


//選択肢テーブルのデータ取得
//  $question_id = filter_input(INPUT_GET, 'id');
//  $question_id = $id ;
//  $choices_sql = 'SELECT id, question_id, name, valid FROM choices  WHERE question_id= ? ';
//  $choices_stmt = $db->prepare($choices_sql);
//  $choices_stmt->bindValue(1,$question_id);
//  $choices_stmt->execute();
//  $choices_result = $choices_stmt->fetchAll();
//  echo "</br>" . "</br>" .  $choices_result[0];
//  echo "</br>" . "</br>" .  $choices_result[1];
//  echo "</br>" . "</br>" .  $choices_result[2];
//  echo "</br>" . "</br>" .  $choices_result['name'];
//  echo "</br>" . "</br>" ;
//  echo "</br>" . "</br>" .  print_r($choices_result);


// 間違えてqueryで書いて一応表示はできることは確認できた
//    設問テーブルのデータ取得
//     $images_sql = 'SELECT id, big_question_id, image FROM questions';
//     $images_stmt = $db->query( $images_sql);
//    選択肢テーブルのデータ取得
//     $choices_sql = 'SELECT id, question_id, name, valid FROM choices';
//     $choices_stmt = $db->query($choices_sql);
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

<?php $x = 1; ?>
<?php foreach ($results as $value): ?>
       <?php if ($x > 1){?>
           <?php break;?>
       <?php } else {?>
          <h2 class='title'>#<?php echo $value['big_quiz_name']?></h2>
       <?php } ?>
    <?php $x++; ?>
<?php endforeach ?>


<div class='mainWrapper'>
    <?php $f=1; foreach ($inner_results as $inner_value): ?>
      <!-- 設問番号↓ -->
         <h3><?php echo $inner_value['image_id']; ?>.この地名はなんて読む？</h3>
      <!-- 写真↓ -->
         <img src= 'img/<?php echo $inner_value['image_name']; ?>'  alt='問題 <?php echo $inner_value['image_id'] ?>の写真' width=auto>
      <!-- 選択肢↓ -->
      <?php for ($i=0; $i < 3; $i++) { ?>
         <ul>
           <li class='buttonOfOptionNumber'><?php echo $inner_value['choice_name'] ?></li>
         </ul>
      <?php } ?>
         

    <?php endforeach ?>

</div>


   <!-- 試しに -->
   <th><br></th><th><br></th>
      <table>
        <tr>
          <th>ループの何回目か</th> 
          <th><br></th>
          <th>ID</th> 
          <th><br></th>
          <th>大問テーブルID (1or2)</th>
          <th><br></th>
          <th>大問テーブル名 (東京or広島)</th>
          <th><br></th>
          <th>設問写真名</th>
        </tr>
        <?php $c=1; foreach ($results as $value): ?>
       <tr>
        <td>
        <?php echo $c++ ?>
        </td>
        <td>
        <?php echo $value['big_quiz_id'] ?> 
        </td>
        <td>
         <?php echo $value['big_quiz_name'] ?>
        </td>
        <td>
         <?php echo $value['image_id'] ?>
        </td>
        <td>
         <?php echo $value['image_name'] ?>
        </td>
      </tr>
      <?php endforeach ?>

      <th><br></th>

      <tr>
          <th>ループの何回目か</th> 
          <th><br></th>
          <th>設問写真ID</th> 
          <th><br></th>
          <th>設問写真名</th>
          <th><br></th>
          <th>設問</th>
          <th><br></th>
          <th>正誤判定(0or1)</th>
      </tr>
      
      <?php $f=1; foreach ($inner_results as $inner_value): ?>
       <tr>
        <td>
        <?php echo $f++ ?>
        </td>
        <td>
         <?php echo $inner_value['image_id'] ?>
        </td>
        <td>
         <?php echo $inner_value['image_name'] ?>
        </td>
        <td>
         <?php echo $inner_value['choice_name'] ?>
        </td>
        <td>
         <?php echo $inner_value['choice_valid'] ?>
        </td>
      </tr>
      <?php endforeach ?>

      <?php $f=1; foreach ($inner_results as $inner_value): ?>
       <tr>
        <td>
         <?php echo $f++ ?>
         <?php echo $inner_value['choice_name'] ?>
        </td>
      </tr>
      <?php endforeach ?>

  <!-- $inner_results[
   $inner_row['image_id'],
   $inner_row['image_name'],
   $inner_row['choice_name'],
   $inner_row['choice_valid']
  ] -->
      <!-- <?php echo $inner_results['choice_name'][0] ?> -->



        <!-- <?php foreach ($images_result as $row_images) {?>
        <tr>
          <td><?php echo $row_images['id']; ?></td>
          <td><?php echo $row_images['big_question_id']; ?></td>
          <td><?php echo $row_images['image']; ?></td>
        </tr>
        <?php } ?>
        <th><br></th>
        <?php foreach ($choices_result as $row_choices) {?>
        <tr>
          <td><?php echo $row_choices['id']; ?></td>
          <td><?php echo $row_choices['question_id']; ?></td>
          <td><?php echo $row_choices['name']; ?></td>
          <td><?php echo $row_choices['valid']; ?></td>
        </tr>
        <?php } ?> -->
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