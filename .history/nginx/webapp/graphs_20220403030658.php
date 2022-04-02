<?php
require_once('config.php');
require_once('functions.php');

// 学習時間 棒グラフ
  // 月別に集計
  $stmt = $db->query('SELECT DATE_FORMAT(`study_date`, "%Y-%m") as `grouping_month`, SUM(study_hour) FROM `study_times` GROUP BY `grouping_month`');
  $results_month_group = $stmt->fetchAll();
  for ($i=0; $i <count($results_month_group); $i++) {  //count($results_month_group)でfor文を要素数までで終わらせる
    $pieces = explode("-", $results_month_group[$i]['grouping_month']);   //$iが最新の月まで回って終わるから、必ずpiecesは最新の月になる
  }
  $piece_year = $pieces[0];            //年を表示
  $piece_month = $pieces[1];           //月を表示
  // echo "<pre>";
  // print_r($results_month_group);
  // print_r($piece_year);
  // print_r($piece_month);
  // echo "</pre>";
  
  
  //下記は後に使う空配列、ここで定義しておく
  $study_times_array = array();
  $study_date_hour_array = array();
  
  for ($i = 1; $i <= date('t', strtotime(`$piece_year-$piece_month`)); $i++) {     // date('t', strtotime(`$piece_year-$piece_month`)); で月の日数分がとれる
    if(preg_match('/^([0-9]{1})$/', $i)){  //もし$iが１桁だったら
      $i = '0'.$i;                         //ゼロ埋めするように'0'を.で
    }                                      //それ以外はそのまま
    $date = "$piece_year-$piece_month-$i";  //上で抽出した年月とiで表した日で日付を表す
    $stmt = $db->prepare('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y-%m-%d") = ?');
    $stmt->bindValue(1,$date);  //
    $stmt->execute();
    $colum_graph_date = $stmt->fetchAll();
  
    if (empty($colum_graph_date[0][0])) {   //NULLなら０を
      array_push($study_times_array, 0);    //empty()…変数が存在しない場合、または値が空かnullがセットされている場合にtrueを返す
    }else{                                  //値があればそれをintに変換して$study_times_arrayに入れる
      array_push($study_times_array, (int)$colum_graph_date[0][0]);
    }
  }
  //このままだと学習時間だけが並んでいる配列、日にちとセットの配列がほしい
  $d = 1;
  foreach ($study_times_array as $study_time_array) {  //１つ１つの学習時間に対して、日にち($d)をセットにし、array_pushで予め用意していた空配列に足していく
    $study_date_hour_array_before = array($d, $study_time_array);   // [日にち, 学習時間]の配列を定義、ここでデータを入れる
    array_push($study_date_hour_array, $study_date_hour_array_before); //空配列に↑の配列を代入する
    $d++; //$study_time_arrayが回るごとに$dを増やしていく
  }
  $study_array_Json = json_encode($study_date_hour_array);  //JavaScriptにPHPの配列を渡すためには、一度配列をJson形式に配列を変換する必要がある
                                                            //Json形式に変換するためには、PHPの関数を使用↓
                                                            // Json形式に変換した配列 = json_encode(変換したい配列) ]

//円グラフ
// 年別に集計
$stmt = $db->query('SELECT SUM(study_hour) FROM study_times WHERE DATE_FORMAT(study_date, "%Y") = DATE_FORMAT(now(), "%Y")');
$results_year= $stmt->fetch();

//学習言語 円グラフ
//↓ WHERE DATE_FORMAT(study_date, "%Y")にしたので年別の円グラフができるようにした
$stmt = $db->query('SELECT
                          SUM(study_times.study_hour) AS study_hour,
                          study_languages.language_name AS language_name,
                          study_languages.language_color AS language_color
                          FROM study_times
                          INNER JOIN study_languages 
                          ON  study_times.languages_id = study_languages.id
                          WHERE DATE_FORMAT(study_date, "%Y") = DATE_FORMAT(now(), "%Y")
                          GROUP BY study_languages.language_name, study_languages.language_color
                          ORDER BY study_hour DESC
                          ');
$results_languages = $stmt->fetchAll();

$languages_name_array = [];
for ($k=0; $k < count($results_languages); $k++) {
  array_push($languages_name_array, $results_languages[$k]['language_name']);
}
$languages_hour_array = [];
for ($h=0; $h < count($results_languages); $h++) {
  $languages_per = ($results_languages[$h]['study_hour']/$results_year[0])*100; // (学習時間 / 年間合計学習時間)*100にして扇形の配分出す
  array_push($languages_hour_array, ($languages_per));  
}
$languages_color_array = [];
for ($c=0; $c < count($results_languages); $c++) {
  $language_color = $results_languages[$c]['language_color'];
  array_push($languages_color_array, $language_color);
}
$languages_name_per_array = [];
$l = 0;
  foreach ($languages_name_array as $language_name_array) {  //１つ１つの学習言語に対して、学習時間($lで判別)をセットにし、array_pushで予め用意していた空配列に足していく
    $languages_name_per_before = array($language_name_array, $languages_hour_array[$l]);   // [学習言語, 学習時間]の配列を定義、ここでデータを入れる
    array_push($languages_name_per_array, $languages_name_per_before); //空配列に↑の配列を代入する
    $l++; //$language_name_arrayが回るごとに$lを増やしていく
  }
  $languages_array_Json = json_encode($languages_name_per_array);



//学習コンテンツ 円グラフ
$stmt = $db->query('SELECT
                          SUM(study_times.study_hour) AS study_hour,
                          study_contents.contents_name AS contents_name,
                          study_contents.contents_color AS contents_color
                          FROM study_times
                          INNER JOIN study_contents 
                          ON  study_times.contents_id = study_contents.id
                          WHERE DATE_FORMAT(study_date, "%Y-%m") = DATE_FORMAT(now(), "%Y-%m")
                          GROUP BY study_contents.contents_name, study_contents.contents_color
                          ORDER BY study_hour DESC
                          ');
$results_contents = $stmt->fetchAll();
$contents_name_array = [];
for ($k=0; $k < count($results_contents); $k++) {
  array_push($contents_name_array, $results_contents[$k]['contents_name']);
}
$contents_hour_array = [];
for ($h=0; $h < count($results_contents); $h++) {
  $contents_per = ($results_contents[$h]['study_hour']/$results_year[0])*100; // (学習時間 / 年間合計学習時間)*100にして扇形の配分出す
  array_push($contents_hour_array, ($contents_per));  
}
$contents_color_array = [];
for ($c=0; $c < count($results_contents); $c++) {
  $contents_color = $results_contents[$c]['contents_color'];
  array_push($contents_color_array, $contents_color);
}
$contents_name_per_array = [];
$l = 0;
  foreach ($contents_name_array as $contents_name_array) {  //１つ１つの学習言語に対して、学習時間($lで判別)をセットにし、array_pushで予め用意していた空配列に足していく
    $contents_name_per_before = array($contents_name_array, $contents_hour_array[$l]);   // [学習言語, 学習時間]の配列を定義、ここでデータを入れる
    array_push($contents_name_per_array, $contents_name_per_before); //空配列に↑の配列を代入する
    $l++; //$language_name_arrayが回るごとに$lを増やしていく
  }
  $contents_array_Json = json_encode($contents_name_per_array);



?>




<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>

/* 棒グラフ */
google.charts.load('current', {
  'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawBarChart);

function drawBarChart() {

  // Create the data table.
  var barChartData = new google.visualization.DataTable();
  let study_array = <?php echo $study_array_Json?>; //PHPからJavaScriptに多次元配列を受け渡す
  console.log(study_array)
  barChartData.addColumn('number', 'day');
  barChartData.addColumn('number', 'time');
  barChartData.addRows(study_array);

  // Set chart options
  var barChartOptions = {
    'width': '100%',
    'height': '100%',
    'legend': 'none',
    'colors': ['#0f71bc'],
    hAxis: {
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
  };

  // Instantiate and draw our chart, passing in some barChartOptions.
  var barChart = new google.visualization.ColumnChart(document.getElementById('barChart__div'));
  barChart.draw(barChartData, barChartOptions);
}



/* 円グラフ */
/* 学習言語 */
google.charts.setOnLoadCallback(drawPieLanguageChart);
function drawPieLanguageChart() {

  // Create the data table.
  var pieChartLeftData = new google.visualization.DataTable();
  let languages_array = <?php echo $languages_array_Json?>; //PHPからJavaScriptに多次元配列を受け渡す
  // let languages_color = <?php echo $languages_color_Json?>; //PHPからJavaScriptに多次元配列を受け渡す
  pieChartLeftData.addColumn('string', 'Topping');
  pieChartLeftData.addColumn('number', 'Slices');
  pieChartLeftData.addRows(languages_array);

  // Set chart options
  var pieChartLeftOptions = {
    'width': '100%',
    'height': '100%',
    'pieHole': 0.4,
    legend: {
      maxLines: 4,
      position: 'none',
    },
    slices: {
      0: {
        color: '<?php echo $languages_color_array[0] ?>'
      },
      1: {
        color: '<?php echo $languages_color_array[1] ?>'
      },
      2: {
        color: '<?php echo $languages_color_array[2] ?>'
      },
      3: {
        color: '<?php echo $languages_color_array[3] ?>'
      },
      4: {
        color: '<?php echo $languages_color_array[4] ?>'
      },
      5: {
        color: '<?php echo $languages_color_array[5] ?>'
      },
      6: {
        color: '<?php echo $languages_color_array[6] ?>'
      },
      7: {
        color: '<?php echo $languages_color_array[7] ?>'
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


/* 学習コンテンツ */
google.charts.setOnLoadCallback(drawPieContentsChart);
function drawPieContentsChart() {

  // Create the data table.
  var pieChartRightData = new google.visualization.DataTable();
  let contents_array = <?php echo $contents_array_Json?>; //PHPからJavaScriptに多次元配列を受け渡す
  pieChartRightData.addColumn('string', 'Topping');
  pieChartRightData.addColumn('number', 'Slices');
  pieChartRightData.addRows(contents_array);

  // Set chart options
  var pieChartRightOptions = {
    'width': '100%',
    'height': '100%',
    'pieHole': 0.4,
    legend: {
      maxLines: 4,
      position: 'none',
    },
    slices: {
      0: {
        color: '<?php echo $contents_color_array[0] ?>'
        // color: '#0042E5'
      },
      1: {
        color: '<?php echo $contents_color_array[1] ?>'
        // color: '#0070B9'
      },
      2: {
        color: '<?php echo $contents_color_array[2] ?>'
        // color: '#00BDDB'
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
  drawPieLanguageChart();
  drawPieContentsChart();
}
</script>