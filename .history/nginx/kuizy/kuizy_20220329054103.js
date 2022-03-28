'use strict';

/**
 * @type {Array} 問題の選択肢と写真の配列
 */

const optionGroups = [
['たかなわ', 'たかわ', 'こうわ'],
['かめいど', 'かめど', 'かめと'],
['こうじまち', 'かゆまち', 'おかとまち'],
['おなりもん', 'ごせいもん', 'おかどもん'],
['とどろき', 'たたら', 'たたりき'],
['しゃくじい', 'せきこうい', 'いじい'],
['ぞうしき', 'ざっしき', 'ざっしょく'],
['おかちまち', 'みとちょう', 'ごしろちょう'],
['ししぼね', 'ろっこつ', 'しこね'],
['こぐれ', 'こばく', 'こしゃく'],
];

/**
 * @type {Array} 問題の正解の配列
 */
const answerGroups = ["たかなわ","かめいど","こうじまち","おなりもん","とどろき","しゃくじい","ぞうしき","おかちまち","ししぼね","こぐれ"]

/**
 * @type {Array} 問題の写真の配列
 */
let questionPhotos = [
['img/takanawa.png'],
['img/kameido.png'],
['img/koujimachi.png'],
['img/onarimon.png'],
['img/todoroki.png'],
['img/syakujii.png'],
['img/zoshiki.png'],
['img/okachimachi.png'],
['img/shishibone.png'],
['img/kogure.png'],
];

/**
 * シャッフル関数、フィッシャー・イェーツのシャッフル
 * @param {Array} arr シャッフル前の問題の配列
 * @return {Array} シャッフル後の問題の配列
 */
function shuffle(arr){ 
	for (let k = arr.length - 1; k > 0; k--){
		const j = Math.floor(Math.random() * (k + 1));
		[arr[j],arr[k]] = [arr[k],arr[j]];
	}
	return arr;
}
optionGroups.map(shuffle);


/**
 * @type {string} 問題作成の空
 */
let main = '';

for(let i = 0; i<optionGroups.length; i++){
	main+=`<div class='mainWrapper'>`
	     +`<h3>${i+1}.この地名はなんて読む？</h3>`
         +`<img src= "${questionPhotos[i]}"  alt='問題${i+1}の写真' width=auto>`
         +`<ul>`
         +`<li class='buttonOfOptionNumber' id = 'answerChoice_${i}_0' input type='button' value='button' onclick="clickSelectedButton(${i},0)">${optionGroups[i][0]}</li>`
         +`<li class='buttonOfOptionNumber' id = 'answerChoice_${i}_1' input type='button' value='button' onclick="clickSelectedButton(${i},1)">${optionGroups[i][1]}</li>`
         +`<li class='buttonOfOptionNumber' id = 'answerChoice_${i}_2' input type='button' value='button' onclick="clickSelectedButton(${i},2)">${optionGroups[i][2]}</li>`
         +`<div id='answerDisplay${[i]}' class='firstIsInvisible'>`
         +`<li><span>正解!</span></li>`
         +`<li>正解は ${answerGroups[i]} です!</li>`
         +`</div>`
         +`<div id='incorrectAnswerDisplay${[i]}' class='incorrectFirstIsInvisible'>`
         +`<li><span>不正解!</span></li>`
         +`<li>正解は ${answerGroups[i]} です!</li>`
         +`</div>`
         +`</ul>`
		 +`</div>`

loop.innerHTML = main;
};


/**
 * 以下で各設問のボタンクリックによって（）内の引数を呼び出す
 * @param {number} questionNumber 大問番号
 * @param {number} optionNumberOfQuestions 選択肢番号
 * @return {Array} シャッフル後の問題の配列
 */
function clickSelectedButton(questionNumber, optionNumberOfQuestions) {
	
	/**
	 * クリックしたらとりあえず全て赤にする
   * @type {string} ボタン表示
   */
	let buttonOfOptionNumber = document.getElementById('answerChoice_'+ questionNumber +'_'+ optionNumberOfQuestions);
	buttonOfOptionNumber.classList.add('incorrectAnswerBox');

	for (let d = 0; d < 3; d++) {
		if (optionGroups[questionNumber][d] === answerGroups[questionNumber]) {
			let trueChoice = document.getElementById('answerChoice_'+ questionNumber +'_'+ d);
			trueChoice.classList.add('answerBox');
			trueChoice.classList.remove('incorrectAnswerBox');
		}
	}

	
	if (optionGroups[questionNumber][optionNumberOfQuestions] === answerGroups[questionNumber]) {
		document.getElementById('answerDisplay'+ questionNumber).style.display = 'block';
	} else {
		document.getElementById('incorrectAnswerDisplay'+ questionNumber).style.display = 'block';
	}

	document.getElementById('answerChoice_'+ questionNumber +'_0').style.pointerEvents = 'none';
	document.getElementById('answerChoice_'+ questionNumber +'_1').style.pointerEvents = 'none';
	document.getElementById('answerChoice_'+ questionNumber +'_2').style.pointerEvents = 'none';
}


/**
 * @type {string} 問題
 * @type {Array} 問題の配列
 * @param {Array} arr シャッフル前の問題の配列
 * @return {Array} シャッフル後の問題の配列
 */
//サイドメニューの開閉
function hamburger() {
  document.getElementById('menu').classList.toggle('in');
}
document.getElementById('hamburger').addEventListener('click' , function () {
  hamburger();
} );

