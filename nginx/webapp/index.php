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

try{
   // PDOインスタンスを生成
  $db = new PDO($PDO_DSN,$DB_USERNAME,$DB_PASSWORD,$OPTIONS);
 
 //学習時間・学習言語テーブルの結合、選択
  $sql = 'SELECT
          study_times.id AS times_id,
          study_times.study_date AS study_date,
          study_times.study_hour AS study_hour,
          study_times.languages_id AS languages_id,
          study_times.contents_id AS contents_id,
          study_languages.language_name AS language_name
          FROM study_times
          INNER JOIN study_languages
          ON  study_times.languages_id = study_languages.id';
  $stmt = $db->query($sql); // SELECT文を変数に格納
  
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
      'times_id' =>$row['times_id'],
      'study_date' =>$row['study_date'],
      'study_hour' =>$row['study_hour'],
      'languages_id' =>$row['languages_id'],
      'contents_id' =>$row['contents_id'],
      'language_name' =>$row['language_name']
   );
 }

//  print_r($results);
 echo $results[0]['study_date']  . PHP_EOL;
 echo $results[1]['study_date']  . PHP_EOL;
 echo $results[2]['study_date']  . PHP_EOL;
 echo $results[3]['study_date']  . PHP_EOL;
 echo $results[4]['study_date']  . PHP_EOL;
 echo $results[5]['study_date']  . PHP_EOL;
 echo $results[6]['study_date']  . PHP_EOL;
 echo $results[7]['study_date']  . PHP_EOL;
 echo $results[8]['study_date']  . PHP_EOL;

//  Array
//  (
//      [0] => Array
//          (
//              [times_id] => 1
//              [study_date] => 2021-07-01 00:00:00
//              [study_hour] => 5
//              [languages_id] => 2
//              [contents_id] => 1
//              [language_name] => css
//          )
//  ......... 
//  )
//  2021-07-01 00:00:00
//  2021-07-03 00:00:00
//  2021-07-04 00:00:00
//  ......... 

 //学習時間・学習コンテンツテーブルの結合、選択
 $sql2 = 'SELECT
               study_times.id AS times_id,
               study_times.study_date AS study_date,
               study_times.study_hour AS study_hour,
               study_times.languages_id AS languages_id,
               study_times.contents_id AS contents_id,
               study_contents.contents_name AS contents_name
               FROM study_times
               INNER JOIN study_contents
               ON  study_times.contents_id = study_contents.id';
  $stmt2 = $db->query($sql2); // SELECT文を変数に格納

  $results2 = array();
  while($row2 = $stmt2->fetch()) {
     $results2[]=array(
      'times_id' =>$row2['times_id'],
      'study_date' =>$row2['study_date'],
      'study_hour' =>$row2['study_hour'],
      'languages_id' =>$row2['languages_id'],
      'contents_id' =>$row2['contents_id'],
      'contents_name' =>$row2['contents_name']
   );
  }

  $cnt = count($results2);               //results2の配列の長さ取得
  for ($i=0; $i < $cnt; $i++) {          //その分回す
    echo  $results2[$i]['contents_name']  . PHP_EOL;
  }
  

  echo $results2[0]['contents_name']  . PHP_EOL;
  echo $results2[1]['contents_name']  . PHP_EOL;
  echo $results2[2]['contents_name']  . PHP_EOL;
  echo $results2[3]['contents_name']  . PHP_EOL;
  echo $results2[4]['contents_name']  . PHP_EOL;
  echo $results2[5]['contents_name']  . PHP_EOL;
  echo $results2[6]['contents_name']  . PHP_EOL;
  echo $results2[7]['contents_name']  . PHP_EOL;
  echo $results2[8]['contents_name']  . PHP_EOL;

  echo $results2[0]['contents_name']  . PHP_EOL;
  echo $results2[1]['contents_name']  . PHP_EOL;
  echo $results2[2]['contents_name']  . PHP_EOL;
  echo $results2[3]['contents_name']  . PHP_EOL;
  echo $results2[4]['contents_name']  . PHP_EOL;
  echo $results2[5]['contents_name']  . PHP_EOL;
  echo $results2[6]['contents_name']  . PHP_EOL;
  echo $results2[7]['contents_name']  . PHP_EOL;
  
 
  // 年別に集計
  // $sql3 = 'SELECT                                                  +------------+
  //               SUM(study_hour) as count_hour                      | count_hour |
  //               FROM study_times                                   +------------+
  //               WHERE DATE_FORMAT(study_date, '%Y') = 2021         |         38 |
  //                ';                                                +------------+
  // $sql3 = 'SELECT                                                  +------------+
  //               SUM(study_hour) as count_hour                      | count_hour |
  //               FROM study_times                                   +------------+
  //               WHERE DATE_FORMAT(study_date, '%Y') = 2022         |          3 |
  //                ';                                                +------------+

  // $sql3 = 'SELECT                                                     
  //               DATE_FORMAT(`study_date`, '%Y') as `grouping_year`,   
  //               SUM(study_hour)                                       
  //               FROM `study_times`                                    
  //               GROUP BY `grouping_year`';                             
  $stmt3 = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y") = DATE_FORMAT(now(), "%Y")')->fetch();
  // $stmt3 = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y") = "2021"')->fetch();
  // print_r($stmt3);
  // foreach ($stmt3 as $results_year) {
  //   echo $results_year."<br>";       //36   36    (2022の場合)
  // }
  // echo $results3;    //36     (2022の場合)

  // $stmt3 = $db->query('SELECT DATE_FORMAT("study_date", "%Y") as "grouping_year", SUM(study_hour) FROM "study_times" GROUP BY "grouping_year"')->fetch();     
                                //これではだめ、ERROR 1055 (42000): Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'webapp.study_times.study_date' which is not functionally 
                                //dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
  $stmt3_2 = $db->query('SELECT DATE_FORMAT(`study_date`, "%Y") as `grouping_year`, SUM(study_hour) FROM `study_times` GROUP BY `grouping_year`');
  // +---------------+-----------------+
  // | grouping_year | SUM(study_hour) |
  // +---------------+-----------------+
  // | 2021          |               5 |
  // | 2022          |              36 |
  // +---------------+-----------------+
  $results3_2 = array();
  while($row3_2 = $stmt3_2->fetch()) {
     $results3_2[]=array(
      'grouping_year' =>$row3_2['grouping_year'],
      'SUM(study_hour)' =>$row3_2['SUM(study_hour)']
   );
  }
  echo $results3_2[0]['grouping_year']  . PHP_EOL;  //2021
  echo $results3_2[1]['grouping_year']  . "<br>";  //2022

  // 月別に集計
  $stmt4 = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m") = DATE_FORMAT(now(), "%Y-%m")')->fetch();
  // $stmt4 = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m") = "2022-02"')->fetch();
  // print_r($stmt4);
  // foreach ($stmt4 as $results_month) {
  //   echo $results_month."<br>";       //6   6    (2022-03の場合)
  // }
  // echo $results_month;    //6

  $stmt4_2 = $db->query('SELECT DATE_FORMAT(`study_date`, "%Y-%m") as `grouping_month`, SUM(study_hour) FROM `study_times` GROUP BY `grouping_month`');
  // +----------------+-----------------+
  // | grouping_month | SUM(study_hour) |
  // +----------------+-----------------+
  // | 2021-07        |               5 |
  // | 2022-01        |              14 |
  // | 2022-02        |              16 |
  // | 2022-03        |               6 |
  // +----------------+-----------------+
  $results4_2 = array();
  while($row4_2 = $stmt4_2->fetch()) {
     $results4_2[]=array(
      'grouping_month' =>$row4_2['grouping_month'],
      'SUM(study_hour)' =>$row4_2['SUM(study_hour)']
   );
  }
  echo $results4_2[0]['grouping_month']  . PHP_EOL;  //2021-07
  echo $results4_2[1]['grouping_month']  . PHP_EOL;  //2022-01
  echo $results4_2[2]['grouping_month']  . PHP_EOL;  //2022-02
  echo $results4_2[3]['grouping_month']  . "<br>";  //2022-03

   // 日別に集計
   $stmt5 = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m-%d") = DATE_FORMAT(now(), "%Y-%m-%d")')->fetch();
   // $stmt5 = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m-%d") = "2022-02-09"')->fetch();
  //  print_r($stmt5);
  //  foreach ($stmt5 as $results_date) {
  //    echo $results_date."<br>";       //3   3    (2022-03-11の場合)
  //  }
  //  echo $results_date;    //3

   $stmt5_2 = $db->query('SELECT DATE_FORMAT(`study_date`, "%Y-%m-%d") as `grouping_date`, SUM(study_hour) FROM `study_times` GROUP BY `grouping_date`');
   //  +---------------+-----------------+
   //  | grouping_date | SUM(study_hour) |
   //  +---------------+-----------------+
   //  | 2021-07-01    |               5 |
   //  | 2022-01-03    |              10 |   //←ちゃんと6+4されてる
   //  | 2022-01-06    |               4 |
   //  | 2022-02-09    |               3 |
   //  | 2022-02-12    |               6 |
   //  | 2022-02-16    |               7 |
   //  | 2022-03-08    |               3 |
   //  | 2022-03-11    |               3 |
   //  +---------------+-----------------+
   $results5_2 = array();
   while($row5_2 = $stmt5_2->fetch()) {
      $results5_2[]=array(
       'grouping_date' =>$row5_2['grouping_date'],
       'SUM(study_hour)' =>$row5_2['SUM(study_hour)']
    );
   }
   echo $results5_2[0]['grouping_date']  . PHP_EOL;  //2021-07-01
   echo $results5_2[1]['grouping_date']  . PHP_EOL;  //2022-01-03
   echo $results5_2[2]['grouping_date']  . PHP_EOL;  //2022-01-06
   echo $results5_2[3]['grouping_date']  . PHP_EOL;  //2022-02-09
   echo $results5_2[4]['grouping_date']  . PHP_EOL;  //2022-02-12
   echo $results5_2[5]['grouping_date']  . PHP_EOL;  //2022-02-16
   echo $results5_2[6]['grouping_date']  . PHP_EOL;  //2022-03-08
   echo $results5_2[7]['grouping_date']  . PHP_EOL;  //2022-03-11
 
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="webapp.css">
  <title>Posse app</title>
</head>
<body>
  <!-- トップ画面 -->
  <div class="footer__fixed">

    <!-- ヘッダー -->
    <header class="header">
      <div class="inner header__inner">
        <img class="posse__logo" src="https://posse.anti-pattern.co.jp/img/posseLogo.png" alt="posseLogo">
        <p class="header__date">4th week</p>
        <button class="header__sending__button"><a href="#modal">記録・投稿</a></button>
      </div>    
    </header>

    <!-- メイン -->
    <main>
      <div class="inner main__inner">
        <section class="main__left">
          <!-- 学習時間 -->
          <div>
            <ul class="main__study__number">
              <li class="main__study__item first__item">
                <div class="main__study__item__title">Today</div>
                <div class="main__study__item__number">3</div>
                <div class="main__study__item__unit">hour</div>
              </li>
              <li class="main__study__item">
                <div class="main__study__item__title">Month</div>
                <div class="main__study__item__number">120</div>
                <div class="main__study__item__unit">hour</div>
              </li>
              <li class="main__study__item last__item">
                <div class="main__study__item__title">Total</div>
                <div class="main__study__item__number">1348</div>
                <div class="main__study__item__unit">hour</div>
              </li>
            </ul>
          </div>
          <!-- 学習時間 棒グラフ -->
          <div class="inner main__bar__graph">
            <div id="barChart__div" class="barChart__div__wrapper" style="width: 96%; height: 85%;"></div>
          </div>
  
        </section>
        <section class="main__right">
          <ul class="main__pie__chart__inner">
            <!-- 学習言語 円グラフ -->
            <li  class="main__pie__chart__item left__item">
              <div class="main__pie__chart__title">学習言語</div>
              <div id="pieChart__left" class="pieChart__position" style="width: 80%; height: 50%;"></div>
              <div class="pie__chart__legend__wrapper">
                <div class="pie__chart__legend__wrapper__small">
                  <div class="pie__chart__legend__items">
                    <div class="pie__chart__circle circle__js">
                      <div class="pie__chart__language ">JavaScript</div>
                    </div> 
                  </div>
                  <div class="pie__chart__legend__items">
                   <div class="pie__chart__circle circle__css">
                    <div class="pie__chart__language pie__chart__language__css">css</div>
                   </div>
                  </div>                
                </div>
                <div class="pie__chart__legend__wrapper__small">
                  <div class="pie__chart__legend__items2">
                    <div class="pie__chart__circle circle__php">
                     <div class="pie__chart__language ">PHP</div>
                    </div>
                  </div>
                   <div class="pie__chart__legend__items2">
                    <div class="pie__chart__circle circle__html">
                     <div class="pie__chart__language active">HTML</div>
                     </div>
                  </div>
                  <div class="pie__chart__legend__items2">
                    <div class="pie__chart__circle circle__laravel">
                     <div class="pie__chart__language ">Laravel</div>
                    </div>
                   </div>                
                </div>
                <div class="pie__chart__legend__wrapper__small">
                   <div class="pie__chart__legend__items">
                    <div class="pie__chart__circle circle__sql">
                     <div class="pie__chart__language ">SQL</div>
                    </div>
                   </div>
                   <div class="pie__chart__legend__items">
                    <div class="pie__chart__circle circle__shell">
                     <div class="pie__chart__language ">SHELL</div>
                    </div>
                   </div>
                </div>
                
                <div class="pie__chart__legend__items">
                 <div class="pie__chart__circle circle__system">
                  <div class="pie__chart__language__system ">情報システム基礎知識（その他）</div>
                 </div>
                </div>
              </div>
            </li>
            <!-- 学習コンテンツ 円グラフ -->
            <li  class="main__pie__chart__item right__item">
               <div class="main__pie__chart__title">学習コンテンツ</div>
               <div id="pieChart__right" class="pieChart__position" style="width: 80%; height: 50%;"></div>
               <div class="pie__chart__legend__wrapper">
                <div class="pie__chart__legend__items__right">
                  <div class="pie__chart__circle circle__js">
                    <div class="pie__chart__legend__contents ">ドットインストール</div>
                  </div> 
                </div>
                <div class="pie__chart__legend__items__right">
                 <div class="pie__chart__circle circle__css">
                  <div class="pie__chart__legend__contents ">N予備校</div>
                 </div>
                </div>
                <div class="pie__chart__legend__items__right">
                 <div class="pie__chart__circle circle__php">
                  <div class="pie__chart__legend__contents ">POSSE課題</div>
                 </div>
                </div>
              </div>
            </li>
          </ul>
    
        </section>
      </div>    
    </main>

    <!-- モーダル画面 -->
    <div class="modal-wrapper" id="modal">
      <a href="#!" class="modal-overlay"></a>
      <div class="modal-window">
        <div class="modal-content">
          <main id="modal__main">
            <div class="inner main__inner__ver__modal">
              <section class="main__left__ver__modal">
                <form action="/" name="contactForm1" class="contact__form1">
                  <dl class="contact__form__list">
                    <div class="contact__form__item contact__form__item__date item__title">
                      <div  id="appendTo">
                        <label for="study__date">学習日</label><br>                      
                        <input type="text" name="study__date" id="study__date">
                      </div>                  
                    </div>
                                      
                    <div class="contact__form__item">
                      <dt class="item__title">学習コンテンツ（複数選択可）</dt>
                      <dd class="self__checkbox" data-toggle="buttons">
                        <input type="checkbox" id="study__contents1" value="N予備校" checked><label for="study__contents1" class="btn active">N予備校</label>
                        <input type="checkbox" id="study__contents2" value="ドットインストール"><label for="study__contents2" class="btn ">ドットインストール</label><br>
                        <input type="checkbox" id="study__contents3" value="POSSE課題"><label for="study__contents3" class="btn ">POSSE課題</label>
                      </dd>
                    </div>
                    <div class="contact__form__item">
                      <dt class="item__title">学習言語（複数選択可）</dt>
                      <dd class="self__checkbox" data-toggle="buttons">
                        <input type="checkbox" id="study__language1" value="HTML" checked><label for="study__language1" class="btn active">HTML</label>
                        <input type="checkbox" id="study__language2" value="css"><label for="study__language2" class="btn ">css</label>
                        <input type="checkbox" id="study__language3" value="JavaScript"><label for="study__language3" class="btn ">JavaScript</label><br>
                        <input type="checkbox" id="study__language4" value="PHP"><label for="study__language4" class="btn ">PHP</label>
                        <input type="checkbox" id="study__language5" value="Laravel"><label for="study__language5" class="btn ">Laravel</label>
                        <input type="checkbox" id="study__language6" value="SQL"><label for="study__language6" class="btn ">SQL</label>
                        <input type="checkbox" id="study__language7" value="SHELL"><label for="study__language7" class="btn ">SHELL</label><br>
                        <input type="checkbox" id="study__language8" value="情報システム基礎知識（その他）"><label for="study__language8" class="btn ">情報システム基礎知識（その他）</label>
                      </dd>
                    </div>
                  </dl>
                </form>        
              </section>
              <section class="main__right__ver__modal">
                <form action="/" name="contactForm2" class="contact__form2">
                  <dl class="contact__form__list">
                    <div class="contact__form__item">
                      <dt class="item__title"><label for="study__hour">学習時間</label></dt>
                      <dd><input id="study__hour" type="text" name="study__hour"></dd>
                    </div>
                  
                    <div class="contact__form__item">
                      <dt class="item__title"><label for="twitter__contents">Twitter用コメント</label></dt>
                      <dd><textarea id="twitter__contents" type="text" name="twitter__contents">test</textarea></dd>
                    </div>
                    <div class="contact__form__item">
                      <dd class="self__checkbox" data-toggle="buttons">
                        <input type="checkbox" id="study__twitter" name="twitterButton" value="twitter">
                        <label for="study__twitter" class="btn twitter__wrapper">
                          <a href="" class="contact__form__twitter item__title">Twitterにシェアする</a>
                        </label>
                      </dd>
                    </div>
                  </dl>                      
                </form> 
              </section>
              
            </div> 
            <div class="contact__form__footer">
              <!-- <button id="record__button" class="header__sending__button__modal"><a href="#modal__determination">記録・投稿</a></button> -->
              <button id="record__button" class="header__sending__button__modal">記録・投稿</button>
            </div>   
            <!-- カレンダー画面の中に表示される決定ボタン 下一行-->
            <button id="determination__button" class="calender__modal__determination__button"><a href="#modal">決定</a></button>
          
            <div class="close__button__wrap">
              <span class="circle__background">
                <a href="#!" class="modal-close">×</a>
              </span>
            </div>
          </main>
        </div>
        
        
      </div>
    </div>

    <!-- ローディング画面 -->
    <div class="modal-wrapper" id="modal__loading">
      <a href="#!" class="modal-overlay"></a>
      <div class="modal-window">
        <div class="modal-content">
          <div class="loader-wrap">
            <div class="loader">Loading...</div>
          </div>          
        </div>
        <!-- <a href="#!" class="modal-close">×</a> -->
      </div>
    </div>

    <!-- 記録・投稿完了画面 -->
    <div class="modal-wrapper" id="modal__determination">
      <a href="#!" class="modal-overlay"></a>
      <div class="modal-window">
        <div class="modal-content-circle">
          <div class="circle__wrap">
            <p class="circle__above">AWESOME!</p>
            <span class="circle">
              <div class="check__mark"></div> 
            </span>
            <div class="circle__explain">記録・投稿</div>
            <div class="circle__explain">完了しました</div>
          </div>        
        </div>
        <div class="close__button__wrap">
          <span class="circle__background">
            <a href="#!" id="modal__determination__close" class="modal-close modal-close__responsive">×</a>
          </span>
        </div>
      </div>
    </div>
    
    <!-- フッター -->
    <footer class="footer">
      <div class="Arrow-Left"></div>
      <p>2020年 10月</p>
      <div class="Arrow-Right"></div>
    </footer>
    <button class="header__sending__button__responsive"><a href="#modal">記録・投稿</a></button>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="webapp.js"></script>
</body>
</html>


</body>
</html>