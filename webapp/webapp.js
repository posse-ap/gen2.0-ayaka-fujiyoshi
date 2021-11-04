/*
 *カレンダー
 */

/* 以下クリックでモーダル風にカレンダー表示 */
let sample = document.getElementById("study__date"); /* flatpickrが発火するid */
let mainWrapper = document.getElementById('modal__main'); /* モーダルを覆うid */
let determinationButton = document.getElementById('determination__button'); /* 完了ボタンid */
let displayCalenderId = document.getElementById('appendTo'); /* カレンダー表示範囲のdivタグのid */

/* カレンダーと決定ボタン表示するクリックイベント */
function displayCalender(){
  mainWrapper.style.visibility = 'collapse'; /* モーダル内の要素を見えなくする */

  let fpPlus = flatpickr(sample, {
    shorthandCurrentMonth: true,
    nextArrow: '<span class="custom">＞</span>',
    prevArrow: '<span class="custom">＜</span>', 
    inline:true , /* 常にカレンダーを開いた状態で表示 */
  }); 
  flatpickr('study__date' , fpPlus); /* ここまで flatpickr オプション変更 */
  
  determinationButton.style.visibility = 'visible';
  displayCalenderId.style.position = 'absolute';
  displayCalenderId.style.left = '29rem';
  displayCalenderId.style.top = '0.1rem';
}
sample.addEventListener('click' ,displayCalender);

/* カレンダーと決定ボタン非表示にするクリックイベント */
function closeCalender(){
  mainWrapper.style.visibility = 'visible';
  let fpPlus = flatpickr(sample, {
    dateFormat: 'Y年n月j日', // フォーマットの変更
    shorthandCurrentMonth: true,
    nextArrow: '<span class="custom">></span>',
    prevArrow: '<span class="custom"><</span>',
    inline:false  /* ボタンを押したらカレンダー閉じる */
  }); 
  flatpickr('study__date' , fpPlus); /* ここまで flatpickr オプション変更 */

  determinationButton.style.visibility = 'hidden';
  displayCalenderId.style.position = 'relative';
  displayCalenderId.style.left = '0rem';
  displayCalenderId.style.top = '0rem';
}
determinationButton.addEventListener('click', closeCalender);




/* 
 *グラフ 
 */

/* 棒グラフ */
// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawBarChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawBarChart() {

  // Create the data table.
  var barChartData = new google.visualization.DataTable();
  barChartData.addColumn('number', 'day');
  barChartData.addColumn('number', 'time');
  barChartData.addRows([
    [1,  3],
    [2,  4],
    [3,  5],
    [4,  3],
    [5,  0],
    [6,  0],
    [7,  4],
    [8,  2],
    [9,  2],
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
    // 'width':580,
    // 'height':320,
    'legend':'none',
    //'colors':['#8bd8f7'],
    'colors':['#0f71bc'],
     hAxis:{
       //showTextEvery:0,
      // scaleType:'number',
      //  baselineColor: 'transparent',
      //maxTextLines:1,
      //maxValue:30,
       textStyle:{ color: '#97b9d1'}, //目盛りの色
       ticks: [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30], //目盛りを自分で設定
       gridlines :{//count:0 ,//補助線消す
                   color:'#fff'
                  },
     },
     vAxis:{
       format:'#h', //単位「ｈ」つける
       gridlines :{count:0},//補助線消す
       textStyle:{ color: '#97b9d1'} ,//目盛りの色
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
                //  'width':280,
                //  'height':300,
                 'pieHole': 0.4,
                 //'legend':'bottom',
                 legend: {
                  maxLines : 4,
                  position: 'none',
                },
                 slices: {
                  0: { color: '#0042E5' },
                  1: { color: '#0070B9' },
                  2: { color: '#00BDDB' },
                  3: { color: '#08CDFA' },
                  4: { color: '#B29DEF' },
                  5: { color: '#6C43E5' },
                  6: { color: '#4609E8' },
                  7: { color: '#2D00BA' },
                },
                chartArea:{left:30,top:30,width:'80%',height:'70%'}
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
                //  'width':280,
                //  'height':300,
                 'pieHole': 0.4,
                 //'legend':'bottom',
                 legend: {
                   maxLines : 4,
                   position: 'none',
                },
                 slices: {
                  0: { color: '#0042E5' },
                  1: { color: '#0070B9' },
                  2: { color: '#00BDDB' },
                },
                chartArea:{left:30,top:30,width:'80%',height:'70%'},
  };

  // Instantiate and draw our chart, passing in some pieChartRightOptions.
  var pieChartRight = new google.visualization.PieChart(document.getElementById('pieChart__right'));
  pieChartRight.draw(pieChartRightData, pieChartRightOptions);
}

// onReSizeイベント
window.onresize = function(){

  drawBarChart();
  drawPieLeftChart();
  drawPieRightChart();
  
}



/* 
 * 記録・投稿ボタン 動き
 */

let twitterCheckBox = document.getElementById('study__twitter'); /* Twitterのチェックボックスid */
let recordButton = document.getElementById('record__button'); /* 記録・投稿ボタンid */
let loadingModal = document.getElementById('modal__loading'); /* ローディング画面id */
let determinationModal = document.getElementById('modal__determination'); /* 記録・投稿完了画面id */
let closeDeterminationModal = document.getElementById('modal__determination__close'); /* 記録・投稿完了画面閉じるid */

//const twitterContents = document.getElementById('twitter__contents'); /* twitter用コメント欄id */
//const s = twitterContents.value;
//let s = document.getElementById("contents").value;



url = document.location.href;


function buttonClick() {
  if (twitterCheckBox.checked === true) {
    // console.log('twitter');
    // window.open(`https://twitter.com/intent/tweet?=${twitterContentsValue}`, '_blank');
    // window.open(`https://twitter.com/intent/tweet?=` + twitterContentsValue, '_blank');
    //console.log(s);

    let twitterContents = document.getElementById('twitter__contents'); /* twitter用コメント欄id */
    let s = twitterContents.value;
    // window.open(`https://twitter.com/intent/tweet?=${s}`, '_blank');
    url = "http://twitter.com/share?url=" + s;
		window.open(url,"_blank","width=600,height=300");
    
  } else {
    // console.log('loading');
    loadingModal.style.visibility = 'visible';
    loadingModal.style.opacity= '1';
    window.setTimeout(function(){
      loadingModal.style.visibility = 'hidden';
      loadingModal.style.opacity= '0';
      determinationModal.style.visibility = 'visible';
      determinationModal.style.opacity= '1';
  }, 3000);
  }
}
function closeModal() {
  determinationModal.style.visibility = 'hidden';
  determinationModal.style.opacity= '0';
}
closeDeterminationModal.addEventListener('click', closeModal);


recordButton.addEventListener('click', buttonClick);

