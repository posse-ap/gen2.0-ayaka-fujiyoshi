<!-- PDOインスタンスを生成  -->

 <?php foreach ($results as  $index => $value): ?>
  <!-- 設問番号↓ -->
     <h3><?php echo $value['image_id']; ?>.この地名はなんて読む？</h3>
  <!-- 写真↓ -->
     <img src= 'img/<?php echo $value['image_name']; ?>'  alt='問題 <?php echo $inner_value['image_id'] ?>の写真' width=auto>
  <!-- 選択肢↓ -->
       <!-- <?php for ($i=0; $i < 1; $i++) { ?> -->
        <!-- [0,1,2] -->
           <ul>
             <li class='buttonOfOptionNumber'><?php echo $inner_results[$index]['choice_name'];?></li>
             <li class='buttonOfOptionNumber'><?php echo $inner_results[$index+1]['choice_name'];?></li>
             <li class='buttonOfOptionNumber'><?php echo $inner_results[$index+2]['choice_name'];?></li>
           </ul>
       <!-- <?php } ?> -->
<?php $x++; ?>
<?php endforeach ?>





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
                    <li class='buttonOfOptionNumber'><?php echo $inner_results[$i]['choice_name'];?></li>
                  </ul>
              <?php } ?>
      <?php $x++; ?>
   <?php endforeach ?>

</div>


<?php
$stmt1 = $pdo->prepare("SELECT * from mix where big_question_id=?");
$stmt2 = $pdo->prepare("SELECT id from mix where big_question_id=?");
$stmt3 = $pdo->prepare("SELECT distinct question_id from mix where big_question_id=?");
$stmt4 = $pdo->prepare("SELECT name from mix where valid=1 and big_question_id=?");
$stmt5 = $pdo->prepare("SELECT name from mix where valid=0 and big_question_id=?");
$stmt6 = $pdo->prepare("SELECT distinct image from mix where big_question_id=?");
$stmt7 = $pdo->prepare("SELECT big_question_name from big_questions where id=?");
$stmt8 = $pdo->prepare("SELECT place from place where id=?");

   for ($i = 1; $i < 9; $i++) {
                ${"stmt".$i}->execute([$id]);
                ${"data" . $i} = ${"stmt" . $i}->fetchAll();
            };
?>




<?php    echo $inner_results[$selection_number[$k]]['choice_name']  . PHP_EOL; ?>