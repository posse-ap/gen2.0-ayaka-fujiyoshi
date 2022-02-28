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

 //設問・選択テーブルの結合、選択
 $inner_sql = "SELECT
               questions.id AS image_id,
               questions.image AS image_name,
               choices.selection_id AS selection_id,
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
        'selection_id' =>$inner_row['selection_id'],
        'choice_name' =>$inner_row['choice_name'],
        'choice_valid' =>$inner_row['choice_valid']
     );
  }

  echo $inner_results[0]['choice_name']  . PHP_EOL;
  echo $inner_results[1]['choice_name']  . PHP_EOL;
  echo $inner_results[2]['choice_name']  . PHP_EOL;
  echo $inner_results[3]['choice_name']  . PHP_EOL;
  echo $inner_results[4]['choice_name']  . PHP_EOL;
  echo $inner_results[5]['choice_name']  . PHP_EOL;

  echo $inner_results[0]['selection_id']  . PHP_EOL;
  echo $inner_results[1]['selection_id']  . PHP_EOL;
  echo $inner_results[2]['selection_id']  . PHP_EOL;
  echo $inner_results[3]['selection_id']  . PHP_EOL;
  echo $inner_results[4]['selection_id']  . PHP_EOL;
  echo $inner_results[5]['selection_id']  . PHP_EOL;

  $correct_array = array();
  for ($j=0; $j < 6; $j++) { 
   if ($inner_results[$j]['choice_valid'] === '1'){
      // echo $inner_results[$j]['choice_name']  . PHP_EOL;
      echo 'correct!' . PHP_EOL;
      $correct_array[] = $inner_results[$j]['choice_name'];
   } else {
      echo 'false...';
   }
  }
  print_r($correct_array);  // Array ( [0] => たかなわ [1] => かめいど ) 
  echo $correct_array[0] . PHP_EOL;  //たかなわ
  echo $correct_array[1] . PHP_EOL;  //かめいど


//配列をシャッフル→選択肢の番号をシャッフルしてシャッフルした値を元に出力
$selection_numbers = [0,1,2]; //ここで番号を用意
shuffle($selection_numbers);
// var_dump($selection_numbers[0]);
// $y = 1;
// for ($m=($y-1)*3; $m < $y*3; $m++) { 
//    $selection_number[$m] = $y*3 + $selection_numbers[0];
// }
// $y++;

$selection_number[0] = 0 + $selection_numbers[0];
$selection_number[1] = 0 + $selection_numbers[1];
$selection_number[2] = 0 + $selection_numbers[2];
$selection_number[3] = 3 + $selection_numbers[0];
$selection_number[4] = 3 + $selection_numbers[1];
$selection_number[5] = 3 + $selection_numbers[2];

// echo $inner_results[$selection_number[0]]['choice_name']  . PHP_EOL; //たかわ
// echo $inner_results[$selection_number[1]]['choice_name']  . PHP_EOL; //こうわ
// echo $inner_results[$selection_number[2]]['choice_name']  . PHP_EOL; //たかなわ
// echo $inner_results[$selection_number[3]]['choice_name']  . PHP_EOL; //かめど
// echo $inner_results[$selection_number[4]]['choice_name']  . PHP_EOL; //かめいど
// echo $inner_results[$selection_number[5]]['choice_name']  . PHP_EOL; //かめと

// echo $selection_number[0] . PHP_EOL; //1→たかわ
// echo $selection_number[1] . PHP_EOL; //2→こうわ
// echo $selection_number[2] . PHP_EOL; //0→たかなわ
// echo $selection_number[3] . PHP_EOL; //4→かめど
// echo $selection_number[4] . PHP_EOL; //5→かめいど
// echo $selection_number[5] . PHP_EOL; //3→かめと
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

<div class='mainWrapper'>
   <!-- タイトル↓ -->
   <h2 class='title'>#<?php echo $results[0]['big_quiz_name']; ?></h2>
 
   <?php $x = 1; ?>
   <?php foreach ($results as $value): ?>
         <!-- 設問番号↓ -->
            <h3><?php echo $value['image_id']; ?>.この地名はなんて読む？</h3>
         <!-- 写真↓ -->
            <img src= 'img/<?php echo $value['image_name']; ?>'  alt='問題 <?php echo $inner_value['image_id'] ?>の写真' width=auto>
         <!-- 選択肢↓ -->
         <!-- 1回目は0,1,2を出力したい、2回目は3,4,5を出力したい -->
            <?php for ($i=($x-1)*3; $i < $x*3; $i++) { ?>
                  <!-- 1回目は$x=1を代入するので、($i=0; $i < 3; $i++)となり、0,1,2まで出力できる -->
                  <!-- 2回目は$x=2を代入するので、($i=3; $i < 6; $i++)となり、3,4,5まで出力できる -->
                     <ul>
                       <li class='buttonOfOptionNumber' input type='button' value='button' onclick="clickSelectedButton()">
                          <?php echo $inner_results[$selection_number[$i]]['choice_name'];?>
                       </li>
                     </ul>
                     
            <?php } ?>
         <!-- 解答ボックス↓ -->
            <div id='answerDisplay<?php echo $x; ?>' class='firstIsInvisible'>
                  <li><span>正解!</span></li>
                  <li>正解は <?php echo $correct_array[$x-1]; ?> です!</li>
            </div>
            <div id='incorrectAnswerDisplay<?php echo $x; ?>' class='incorrectFirstIsInvisible'>
                  <li><span>不正解!</span></li>
                  <li>正解は <?php echo $correct_array[$x-1]; ?> です!</li>
            </div>

            <?php print_r($correct_array[$x-1]); ?>
   <?php $x++; ?>
   <?php endforeach ?>
   

   
   
   

</div>

<!-- 試しに -->
   <th><br></th><th><br></th>
      <table>
        <tr>
          <th>big_quiz_id</th> 
          <th>big_quiz_name</th>
          <th>image_id</th>
          <th>image_name</th>
        </tr>
       <?php foreach ($results as $value): ?>
        <tr>
          <td>
           <?php echo $value['big_quiz_id']; ?> 
          </td>
          <td>
           <?php echo $value['big_quiz_name']; ?>
          </td>
          <td>
           <?php echo $value['image_id']; ?>
          </td>
          <td>
           <?php echo $value['image_name']; ?>
          </td>
        </tr>
      <?php endforeach ?>

      <th><br></th>

      <tr>
          <th>image_id</th> 
          <th>image_name</th>
          <th>selection_id</th>
          <th>choice_name</th>
          <th>choice_valid</th>
      </tr>
      
      <?php foreach ($inner_results as $inner_value): ?>
       <tr>
        <td>
         <?php echo $inner_value['image_id'] ?>
        </td>
        <td>
         <?php echo $inner_value['image_name'] ?>
        </td>
        <td>
         <?php echo $inner_value['selection_id'] ?>
        </td>
        <td>
         <?php echo $inner_value['choice_name'] ?>
        </td>
        <td>
         <?php echo $inner_value['choice_valid'] ?>
        </td>
      </tr>
      <?php endforeach ?>
      <th><br></th> 
   </table>



   <script>
      <?php $y = 1; ?>
      <?php foreach ($results as $value): ?>
      <?php for ($k=($y-1)*3; $k < $y*3; $k++) {  ?>
        
      <?php $z = 1; ?>
         function clickSelectedButton() {
            <?php if ($inner_results[$selection_number[$k]]['choice_name'] == $correct_array[$y-1]){ ?>
               document.getElementById('answerDisplay<?php echo $z ?>').style.display = 'block'; 
                document.getElementById("<?php echo $inner_results[$selection_number[$k]]['choice_name']; ?>").style.display = 'block'; ;
                document.getElementById("<?php echo $correct_array[$y-1] ;?>").style.display = 'block'; 
                document.getElementById("<?php echo $k;?>").style.display = 'block'; 
                document.getElementById("<?php echo $y;?>").style.display = 'block'; 
                document.getElementById("<?php echo $z;?>").style.display = 'block'; 
            <?php } else {  ?>
                     document.getElementById('incorrectAnswerDisplay<?php echo $z ?>').style.display = 'block';
            <?php }  ?>
         }
      <?php $z++; ?>
      <?php } ?>
      <?php $y++; ?>
      
      <?php endforeach ?>
      //window.onload の時点で 
      //  window.onload = clickSelectedButton();
   </script>
   
</body>
</html>