/* flatpickr オプション変更 */
var sample = document.getElementById('study__date');
//var display = document.getElementById('calender__display');
var fp = flatpickr(sample, {
  dateFormat: 'Y年n月j日', // フォーマットの変更
  shorthandCurrentMonth: true,
  // appendTo: appendTo
  //minDate:"today"//今日までの日付を非表示にする
});

/* クリックでモーダル風にカレンダー表示 */
let mainWrapper = document.getElementById('modal__main');
let determinationButton = document.getElementById('determination__button');
//let calenderCss = document.getElementsByClassName("flatpickr-calendar inline");
let displayCalenderId = document.getElementById('appendTo');

/* カレンダーと決定ボタン表示するクリックイベント */
function displayCalender(){
  mainWrapper.style.visibility = 'collapse'; /* モーダル内の要素を見えなくする */
  determinationButton.style.visibility = 'visible';
  var fpPlus = flatpickr(sample, {
    // positionElement: display , /* inline使うと指定できない？ */
    inline:true , /* 常にカレンダーを開いた状態で表示 */
  }); 
  flatpickr('study__date' , fpPlus);
  // calenderCss.style.position = 'absolute';
  // calenderCss.style.top = '22rem';
  // calenderCss.style.left = '20rem';  
  /* 発火される前にこのJS読み込まれてるから、発火された後に出てくるcssは取得出来ない？ */
  displayCalenderId.style.position = 'absolute';
  displayCalenderId.style.left = '25rem';
  displayCalenderId.style.top = '0.1rem';
}
sample.addEventListener('click' ,displayCalender);

/* カレンダーと決定ボタン非表示にするクリックイベント */
function closeCalender(){
  mainWrapper.style.visibility = 'visible';
  var fpPlus = flatpickr(sample, {
    inline:false  /* 常にカレンダーを開いた状態で表示 */
  }); 
  flatpickr('study__date' , fpPlus);
  determinationButton.style.visibility = 'hidden';

  displayCalenderId.style.position = 'relative';
  displayCalenderId.style.left = '0rem';
  displayCalenderId.style.top = '0rem';
}

determinationButton.addEventListener('click', closeCalender);

