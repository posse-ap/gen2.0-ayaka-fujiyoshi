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
    let twitterContents = document.getElementById('twitter__contents'); /* twitter用コメント欄id */
    let s = twitterContents.value;
    url = "http://twitter.com/share?url=" + s;
		window.open(url,"_blank","width=600,height=300");

    //ローディング画面と完了画面追加
    loadingModal.style.visibility = 'visible';
    loadingModal.style.opacity= '1';
    window.setTimeout(function(){
      loadingModal.style.visibility = 'hidden';
      loadingModal.style.opacity= '0';
      determinationModal.style.visibility = 'visible';
      determinationModal.style.opacity= '1';
    }, 3000);
    
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

