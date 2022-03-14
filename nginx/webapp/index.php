<?php
require_once('config.php');

try {
  $db = new PDO($PDO_DSN, $DB_USERNAME, $DB_PASSWORD, $OPTIONS);  // PDOインスタンスを生成

  //学習時間・学習言語テーブルの結合、選択
  $stmt = $db->query('SELECT
                           study_times.id AS times_id,
                           study_times.study_date AS study_date,
                           study_times.study_hour AS study_hour,
                           study_times.languages_id AS languages_id,
                           study_times.contents_id AS contents_id,
                           study_languages.language_name AS language_name
                           FROM study_times
                           INNER JOIN study_languages
                           ON  study_times.languages_id = study_languages.id');
  echo 'DB接続成功';
} catch (PDOException $e) {         //エラー情報が入ったオブジェクトを e で受け取り, getMessage() というメソッドで表示
  echo $e->getMessage() . PHP_EOL;
  echo 'DB接続失敗';
  exit;
}

$results = array();
while ($row = $stmt->fetch()) {
  $results[] = array(
    'times_id' => $row['times_id'],
    'study_date' => $row['study_date'],
    'study_hour' => $row['study_hour'],
    'languages_id' => $row['languages_id'],
    'contents_id' => $row['contents_id'],
    'language_name' => $row['language_name']
  );
}

//学習時間・学習コンテンツテーブルの結合、選択
$stmt = $db->query('SELECT
                          study_times.id AS times_id,
                          study_times.study_date AS study_date,
                          study_times.study_hour AS study_hour,
                          study_times.languages_id AS languages_id,
                          study_times.contents_id AS contents_id,
                          study_contents.contents_name AS contents_name
                          FROM study_times
                          INNER JOIN study_contents
                          ON  study_times.contents_id = study_contents.id');
$results = array();
while ($row = $stmt->fetch()) {
  $results[] = array(
    'times_id' => $row['times_id'],
    'study_date' => $row['study_date'],
    'study_hour' => $row['study_hour'],
    'languages_id' => $row['languages_id'],
    'contents_id' => $row['contents_id'],
    'contents_name' => $row['contents_name']
  );
}

// 年別に集計
$stmt = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y") = DATE_FORMAT(now(), "%Y")')->fetch();
foreach ($stmt as $results_year) {
}
$stmt = $db->query('SELECT DATE_FORMAT(`study_date`, "%Y") as `grouping_year`, SUM(study_hour) FROM `study_times` GROUP BY `grouping_year`');
$results_year_group = array();
while ($row_year = $stmt->fetch()) {
  $results_year_group[] = array(
    'grouping_year' => $row_year['grouping_year'],
    'SUM(study_hour)' => $row_year['SUM(study_hour)']
  );
}


// 月別に集計
$stmt = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m") = DATE_FORMAT(now(), "%Y-%m")')->fetch();
foreach ($stmt as $results_month) {
}
$stmt = $db->query('SELECT DATE_FORMAT(`study_date`, "%Y-%m") as `grouping_month`, SUM(study_hour) FROM `study_times` GROUP BY `grouping_month`');
$results = array();
while ($row = $stmt->fetch()) {
  $results[] = array(
    'grouping_month' => $row['grouping_month'],
    'SUM(study_hour)' => $row['SUM(study_hour)']
  );
}
$pieces = explode("-", $results[0]['grouping_month']);  //年と月を分別する
$piece_year = $pieces[0];        //年を表示
$piece_month = (int)$pieces[1];  //月を表示（stringからintに変換）



// 日別に集計
$stmt = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m-%d") = DATE_FORMAT(now(), "%Y-%m-%d")')->fetch();  // NULL
// ↓これらは表示できた。→ DATE_FORMAT(now(), "%Y-%m-%d") のに問題あり？
  // $stmt = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m") = DATE_FORMAT(now(), "%Y-%m")')->fetch();   //-%d だけとってみた、表示できた
  // $stmt = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m-%d") = "2022-03-14"')->fetch();               //"2022-03-14"のデータがないのかと思ったがこれで表示できた
foreach ($stmt as $results_date) {
  echo $results_date;
}
$stmt = $db->query('SELECT DATE_FORMAT(`study_date`, "%Y-%m-%d") as `grouping_date`, SUM(study_hour) FROM `study_times` GROUP BY `grouping_date`');
$results = array();
while ($row = $stmt->fetch()) {
  $results[] = array(
    'grouping_date' => $row['grouping_date'],
    'SUM(study_hour)' => $row['SUM(study_hour)']
  );
}


for ($i = 1; $i <= date('t', strtotime(`$piece_year-$piece_month`)); $i++) {     // date('t', strtotime(`$piece_year-$piece_month`)); で月の日数分がとれる
  $stmt = $db->prepare('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m-%d") = DATE_FORMAT(now(), "%Y-%m-%d")')->fetchAll();
  
}


?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="webapp.css?v=<?php echo date('s'); ?>">
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
                <!-- <div class="main__study__item__number">3</div> -->
                <div class="main__study__item__number"><?php echo $results_date; ?></div>
                <div class="main__study__item__unit">hour</div>
              </li>
              <li class="main__study__item">
                <div class="main__study__item__title">Month</div>
                <!-- <div class="main__study__item__number">120</div> -->
                <div class="main__study__item__number"><?php echo $results_month; ?></div>
                <div class="main__study__item__unit">hour</div>
              </li>
              <li class="main__study__item last__item">
                <div class="main__study__item__title">Total</div>
                <!-- <div class="main__study__item__number">1348</div> -->
                <div class="main__study__item__number"><?php echo $results_year; ?></div>
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
            <li class="main__pie__chart__item left__item">
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
            <li class="main__pie__chart__item right__item">
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
                    <div id="appendTo">
                      <label for="study__date">学習日</label><br>
                      <input type="text" name="study__date" id="study__date">
                    </div>
                  </div>

                  <div class="contact__form__item">
                    <dt class="item__title">学習コンテンツ（複数選択可）</dt>
                    <dd class="self__checkbox" data-toggle="buttons">
                      <input type="checkbox" id="study__contents1" value="N予備校" checked><label for="study__contents1"
                        class="btn active">N予備校</label>
                      <input type="checkbox" id="study__contents2" value="ドットインストール"><label for="study__contents2"
                        class="btn ">ドットインストール</label><br>
                      <input type="checkbox" id="study__contents3" value="POSSE課題"><label for="study__contents3"
                        class="btn ">POSSE課題</label>
                    </dd>
                  </div>
                  <div class="contact__form__item">
                    <dt class="item__title">学習言語（複数選択可）</dt>
                    <dd class="self__checkbox" data-toggle="buttons">
                      <input type="checkbox" id="study__language1" value="HTML" checked><label for="study__language1"
                        class="btn active">HTML</label>
                      <input type="checkbox" id="study__language2" value="css"><label for="study__language2"
                        class="btn ">css</label>
                      <input type="checkbox" id="study__language3" value="JavaScript"><label for="study__language3"
                        class="btn ">JavaScript</label><br>
                      <input type="checkbox" id="study__language4" value="PHP"><label for="study__language4"
                        class="btn ">PHP</label>
                      <input type="checkbox" id="study__language5" value="Laravel"><label for="study__language5"
                        class="btn ">Laravel</label>
                      <input type="checkbox" id="study__language6" value="SQL"><label for="study__language6"
                        class="btn ">SQL</label>
                      <input type="checkbox" id="study__language7" value="SHELL"><label for="study__language7"
                        class="btn ">SHELL</label><br>
                      <input type="checkbox" id="study__language8" value="情報システム基礎知識（その他）"><label for="study__language8"
                        class="btn ">情報システム基礎知識（その他）</label>
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
          <button id="determination__button" class="calender__modal__determination__button"><a
              href="#modal">決定</a></button>

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
    <p>
      <span><?php echo $piece_year; ?></span>
      年
      <span><?php echo $piece_month; ?></span>
      月
    </p>
    <div class="Arrow-Right"></div>
  </footer>
  <button class="header__sending__button__responsive"><a href="#modal">記録・投稿</a></button>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script>
  /* 棒グラフ */
  // Load the Visualization API and the corechart package.
  google.charts.load('current', {
    'packages': ['corechart']
  });

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawBarChart);

  function drawBarChart() {

    // Create the data table.
    var barChartData = new google.visualization.DataTable();
    barChartData.addColumn('number', 'day');
    barChartData.addColumn('number', 'time');
    barChartData.addRows([
      //['day', 'time']
      [1, 3],
      [2, 4],
      [3, 5],
      [4, 3],
      [5, 0],
      [6, 0],
      [7, 4],
      [8, 2],
      [9, 2],
      [10, 8],
      [11, 8],
      [12, 2],
      [13, 2],
      [14, 1],
      [15, 7],
      [16, 4],
      [17, 4],
      [18, 3],
      [19, 3],
      [20, 3],
      [21, 2],
      [22, 2],
      [23, 6],
      [24, 2],
      [25, 2],
      [26, 1],
      [27, 1],
      [28, 1],
      [29, 7],
      [30, 8],
    ]);

    // Set chart options
    var barChartOptions = {
      'width': '100%',
      'height': '100%',
      'legend': 'none',
      //'colors':['#8bd8f7'],
      'colors': ['#0f71bc'],
      hAxis: {
        //showTextEvery:0,
        // scaleType:'number',
        //  baselineColor: 'transparent',
        //maxTextLines:1,
        //maxValue:30,
        textStyle: {
          color: '#97b9d1'
        }, //目盛りの色
        ticks: [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30], //目盛りを自分で設定
        gridlines: { //count:0 ,//補助線消す
          color: '#fff'
        },
      },
      vAxis: {
        format: '#h', //単位「ｈ」つける
        gridlines: {
          count: 0
        }, //補助線消す
        textStyle: {
          color: '#97b9d1'
        }, //目盛りの色
        baselineColor: 'transparent',
      },
      //backgroundColor: '#fcc',
    };

    // Instantiate and draw our chart, passing in some barChartOptions.
    var barChart = new google.visualization.ColumnChart(document.getElementById('barChart__div'));
    barChart.draw(barChartData, barChartOptions);
  }



  /* 円グラフ */
  /* left 学習言語 */
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawPieLeftChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawPieLeftChart() {

    // Create the data table.
    var pieChartLeftData = new google.visualization.DataTable();
    pieChartLeftData.addColumn('string', 'Topping');
    pieChartLeftData.addColumn('number', 'Slices');
    pieChartLeftData.addRows([
      ['HTML', 30],
      ['CSS', 20],
      ['JavaScript', 10],
      ['PHP', 5],
      ['Laravel', 5],
      ['SQL', 20],
      ['SHELL', 20],
      ['その他', 10]
    ]);

    // Set chart options
    var pieChartLeftOptions = {
      'width': '100%',
      'height': '100%',
      'pieHole': 0.4,
      //'legend':'bottom',
      legend: {
        maxLines: 4,
        position: 'none',
      },
      slices: {
        0: {
          color: '#0042E5'
        },
        1: {
          color: '#0070B9'
        },
        2: {
          color: '#00BDDB'
        },
        3: {
          color: '#08CDFA'
        },
        4: {
          color: '#B29DEF'
        },
        5: {
          color: '#6C43E5'
        },
        6: {
          color: '#4609E8'
        },
        7: {
          color: '#2D00BA'
        },
      },
      chartArea: {
        left: 40,
        top: 15,
        width: '100%',
        height: '70%'
      }
    };

    // Instantiate and draw our chart, passing in some pieChartLeftOptions.
    var pieChartLeft = new google.visualization.PieChart(document.getElementById('pieChart__left'));
    pieChartLeft.draw(pieChartLeftData, pieChartLeftOptions);
  }


  /* right 学習コンテンツ */
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawPieRightChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawPieRightChart() {

    // Create the data table.
    var pieChartRightData = new google.visualization.DataTable();
    pieChartRightData.addColumn('string', 'Topping');
    pieChartRightData.addColumn('number', 'Slices');
    pieChartRightData.addRows([
      ['N予備校', 40],
      ['ドットインストール', 20],
      ['課題', 40]
    ]);

    // Set chart options
    var pieChartRightOptions = {
      'width': '100%',
      'height': '100%',
      'pieHole': 0.4,
      //'legend':'bottom',
      legend: {
        maxLines: 4,
        position: 'none',
      },
      slices: {
        0: {
          color: '#0042E5'
        },
        1: {
          color: '#0070B9'
        },
        2: {
          color: '#00BDDB'
        },
      },
      chartArea: {
        left: 40,
        top: 15,
        width: '100%',
        height: '70%'
      },
    };

    // Instantiate and draw our chart, passing in some pieChartRightOptions.
    var pieChartRight = new google.visualization.PieChart(document.getElementById('pieChart__right'));
    pieChartRight.draw(pieChartRightData, pieChartRightOptions);
  }



  // onReSizeイベント
  window.onresize = function() {

    drawBarChart();
    drawPieLeftChart();
    drawPieRightChart();
    //google.charts.load('current', {'packages':['corechart']});

  }
  </script>
  <script src="webapp.js?v=<?php echo date('s'); ?>"></script>
</body>

</html>


</body>

</html>