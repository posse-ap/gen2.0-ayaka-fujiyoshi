<!-- PDOインスタンスを生成 -->
<?php
 $db = new PDO($PDO_DSN,$DB_USERNAME,$DB_PASSWORD,$OPTIONS);
?>

<!-- メモ -->
 <div class='mainWrapper'>
 <?php $x = 1; ?>
 <?php $limit = 2; ?>

 <?php $y = 1; ?>
 <?php $limitY = 3; ?>

 <?php foreach ($images_stmt as $row_images) {?>
    <?php if ($x > $limit){?>
       <?php break;?>
    <?php } else {?>
        <!-- 設問番号↓ -->
              <h3><?php echo $row_images['id']; ?>.この地名はなんて読む？</h3>
        <!-- 写真↓ -->
              <img src= 'img/<?php echo $row_images['image']; ?>'  alt='問題${i+1}の写真' width=auto>
        <!-- 選択肢↓ -->
              <?php foreach ($choices_stmt as $row_choices) {?>
                   <?php if ($y > $limitY){?>
                      <?php break;?>
                   <?php } else {?>
                    <ul>
                       <li class='buttonOfOptionNumber' id = 'answerChoice_${i}_0' ><?php echo $row_choices['name']; ?></li>
                       <!-- <li class='buttonOfOptionNumber' id = 'answerChoice_${i}_1' ><?php echo $row_choices['name']; ?></li> -->
                       <!-- <li class='buttonOfOptionNumber' id = 'answerChoice_${i}_2' ><?php echo $row_choices['name']; ?></li> -->
                    </ul>
                    <?php $y++; ?>
                 <?php } ?>
                
              <?php } ?>
    <?php } ?>
    <?php $x++; ?>
 <?php } ?>